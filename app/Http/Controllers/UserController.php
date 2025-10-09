<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Repositories\Interfaces\UserRepo;

class UserController extends Controller {
    public function __construct(private UserRepo $repo) {
        
    }
    function show() {
        return view::make('user');
    }


    function add(Request $request) {
        $user=User::factory()->make($request->request->all());
        $this->repo->add($user);
    }
}