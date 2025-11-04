<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Login;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationController extends Controller {
    public function __construct(private AuthenticationService $auth) {}

    public function login(Request $request) {
        try {
            $login = Login::create($request->only(['epost', 'losenord']));
            $user = $this->auth->attemptLogin($login);

            if (!$user) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $accessToken = $this->auth->createAccessTokensForUser($user);
            $refreshToken = $this->auth->createAndStoreRefreshToken($user);

            // Secure-cookie endast i produktion
            $secure = env('APP_ENV') === 'production';
            $cookie = Cookie::create(
                'refresh_token',
                $refreshToken,
                time() + env('REFRESH_TTL', 2592000),
                'refresh',
                null,
                $secure,
                true,
                false,
                'Lax'
            );

            return response()->json([
                'access_token' => $accessToken,
                'token_type' => 'bearer',
                'expires_in' => (int)env('JWT_TTL', 900)
            ])->withCookie($cookie);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function refresh(Request $request) {
        try {
            $cookie = $request->cookie('refresh_token');
            if (!$cookie) {
                return response()->json(['error' => 'No refresh token']);
            }

            $user = $this->auth->validateRefreshTokenAndGetUser($cookie);
            if (!$user) {
                $clear = Cookie::create(
                    'refresh_token', '', -1, "refresh",
                    null, false, true
                );
                return response()->json(['error' => 'Invalid refresh token'])->withCookie($clear);
            }

            // Skapa nytt refresh-token
            $newRefresh = $this->auth->createAndStoreRefreshToken($user);
            $accesstoken = $this->auth->createAccessTokensForUser($user);
            // Secure-cookie endast i produktion
            $secure = env('APP_ENV') === 'production';
            $cookie = Cookie::create(
                'refresh_token',
                $newRefresh,
                time() + env('REFRESH_TTL', 2592000),
                'refresh',
                null,
                $secure,
                true,
                false,
                'Lax'
            );

            return response()->json([
                'access_token' => $accesstoken,
                'token_type' => 'bearer',
                'expires_in' => (int)env('JWT_TTL', 900)
            ])->withCookie($cookie);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function logout(Request $request) {
        try {
            $cookie = $request->cookie('refresh_token');
            if ($cookie) {
                $user = $this->auth->validateRefreshTokenAndGetUser($cookie);
                if ($user) {
                    $this->auth->revokeRefreshToken($user);
                }
            }

            $clear = Cookie::create(
                'refresh_token', '', -1, "refresh",
                null, false, true
            );
            return response()->json(['logged out' => true])->withCookie($clear);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}