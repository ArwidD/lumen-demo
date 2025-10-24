<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepo;

class UserApiController extends Controller {
    public function __construct(private UserRepo $repo) {}

    public function all() {
        $lista = $this->repo->all();
        return response()->json(['users' => $lista]);   
    }
}