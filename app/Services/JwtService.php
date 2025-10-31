<?php

namespace App\Services;

use Firebase\JWT\JWT;

class JwtService {
    protected string $secret;

    protected int $ttl;

    protected string $issuer;

    public function __construct() {
        $this->secret = env('JWT_SECRET', 'secret');
        $this->ttl =env('JWT_TTL', 900);
        $this->issuer = env('JWT_ISSUER', 'me');
}

/**
 * Skapar ett accesstoken innehållande den inskickade arrayen
 * @param array $claims
 * @return string
 */

public function makeAccessToken(array $claims) {
    $now = time();
    $payload = array_merge($claims, [
        'iss' => $this->issuer,
        'iat' => $now,
        'nbf' => $now,
        'exp' => $now + $this->ttl
    ]);
    return JWT::encode($payload, $this->secret, 'HS256');
}
public function decodeAccessToken() {
    try {
        JWT::$leeway=60;
        return JWT::decode($token, new Key($this->secret, 'HS256'));
    } catch (\Exception $e) {
        return null;

    }

}
}
