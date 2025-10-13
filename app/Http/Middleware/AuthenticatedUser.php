<?php

namespace App\Http\Middleware;

use App\Repositories\Interfaces\UserRepo;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AuthenticatedUser {
    public function __construct(private UserRepo $repo) {}

    public function handle($request, \Closure $next) {
        if (!$request->session()->has('user_id')) {
            // Användaren är inte inloggad - redirecta till login-sidan
            return redirect('/login');//->with('errors', ['Du måste logga in först']);
        }
        // Hämta användaren
        $user = $this->repo->get($request->session()->get('user_id'));
        if (!$user) {
            throw new BadRequestException('User not found in database');
        }

        // skicka med användaren i requesten
        $request->setUserResolver(fn() => $user);

        return $next($request);
    }
}