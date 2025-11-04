<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller {
    public function __construct(private UserRepo $repo) {}

    public function show() {
            return View::make('register');
    }

    public function register(Request $request) {
        try {

        $user = User::factory()->make($request->request->all());
        $this->repo->add($user);

        return redirect('/login');
        } catch (\Exception $e) {
            return View::make('register', ['meddelande'=>$e->getMessage()]);
        }
    }
}