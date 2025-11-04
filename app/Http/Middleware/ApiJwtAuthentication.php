<?php

namespace App\Http\Middleware;

use App\Repositories\Interfaces\UserRepo;
use App\Services\JwtService;

class ApiJwtAuthentication {
    public function __construct(private JwtService $jwt, private UserRepo $users) {}

    public function handle($request, \Closure $next) {
        $header=$request->header('Authorization','');
        // Ingen 'Authorization'-header, eller ingen Bearer i headern -> Avsluta
        if(!$header || !preg_match('/Bearer\s+(.+)/', $header, $m)) {
            return response()->json(['Error'=>'Unauthorized'], 401);
        }

        $token=$m[1];
        $payload=$this->jwt->decodeAccessToken($token);
        if(!$payload) {
            return response()->json(['error'=>'Invalid or expired token'], 401);
        }

        $userId=$payload->sub ?? null;
        if(!$userId) {
            return response()->json(['error'=>'Invalid token payload'], 401);
        }

        $user=$this->users->get($userId);
        if(!$user) {
            return response()->json(['error'=>'User not found'], 401);
        }

        $request->setUserResolver(fn()=>$user);

        return $next($request);
    }

}