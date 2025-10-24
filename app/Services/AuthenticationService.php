<?php

namespace App\Services;

use App\Models\Login;
use App\Repositories\Interfaces\UserRepo;
use Illuminate\Support\Facades\Hash;

class AuthenticationService {
    public function __construct(private UserRepo $repo) {

    }

    public function attemptLogin(Login $login) {
        $user=$this->repo->getUserByEmail($login->getEpost());
        if($user && Hash::check($login->getLosenord(), $user->losenord)) {
            return $user;
        }
        return null;
    }
}