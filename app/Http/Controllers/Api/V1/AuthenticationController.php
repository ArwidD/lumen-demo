<?php

namespace App\Http\Controllers\Api\V1;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use App\Services\AuthenticationService;
use App\Models\Login;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationController extends Controller{

    public function __construct(private AuthenticationService $auth){

    }

        public function login(Request $request){
        
            $login=Login::create($request->only(['epost','losenord']));
            $user=$this->auth->attemptLogin($login);

            if(!$user) {
                return response()->json(['error'=>'Invalid credentials'], 401);
            }
        

        $accessToken = $this->auth->createAccessTokensForUser($user);
        $refreshToken=$this->auth->createAndStoreRefreshToken($user);

        //secure-cookie endast i produktion
        $secure=env('APP_ENV')==='production';
        $cookie=Cookie::create(
            'refresh_token',
            $refreshToken,
            time()+env('REFRESH_TTL', 2592000), 
            '/api/v1/refresh',
            null,
            $secure,
            true,
            false,
            'Lax'
        );

        return response()->json([
            'access_token'=>$accessToken,
            'token_type'=>'Bearer',
            'expires_in'=>env('JWT_TTL',900)
        ])->withCookie($cookie);
    }

    public function refresh(Request $request) {
        $cookie=$request->cookie('refresh_token');
        if(!$cookie) {
            return response()->json(['error'=>'No refresh token'], 401);
    }

    $user=$this->auth->validateRefreshTokenAndGetUser($cookie);
    if(!$user) {
        $clear = Cookie::create(
            'refresh_token', '', -1, "/refresh",
            null, false, true
        );
        return response()->json(['error'=>'Invalid refresh token'])->withCookie($clear);
    }

    //skapa ny refresh token
    $newRefresh=$this->auth->createAndStoreRefreshToken($user);
    $accesstoken=$this->auth->createAccessTokensForUser($user);

            //secure-cookie endast i produktion
        $secure=env('APP_ENV')==='production';
        $cookie=Cookie::create(
            'refresh_token',
            $newRefresh,
            time()+env('REFRESH_TTL', 2592000), 
            '/api/v1/refresh',
            null,
            $secure,
            true,
            false,
            'Lax'
        );

        return response()->json([
            'access_token'=>$accesstoken,
            'token_type'=>'Bearer',
            'expires_in'=>env('JWT_TTL',900)
        ])->withCookie($cookie);
}

public function logout(Request $request) {
    $cookie=$request->cookie('refresh_token');
    if($cookie) {
        $user=$this->auth->validateRefreshTokenAndGetUser($cookie);
        if($user) {
            //ta bort refresh token från databasen
            $this->auth->revokeRefreshToken($user);
        }
    }

     $clear = Cookie::create(
            'refresh_token', '', -1, "/api/v1/refresh",
            null, false, true
        );
        return response()->json(['Logged out' => true])->withCookie($clear);
}
}