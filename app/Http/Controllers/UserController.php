<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller {

    public function __construct(private UserRepo $repo) {}

    function show(Request $request) {
        $lista = $this->repo->all();

        // Hämta inloggad användare
        $me = $request->user();
        return View::make('user', ['lista' => $lista, 'me' => $me]);
    }

    public function showUser(Request $request) {
        $id = $request->route('id');
        $user = $this->repo->get($id);

        // Hämta inloggad användare
        $me = $request->user();
        if($me->admin || isset($user) && $me->id == $user->id) {
        return View::make('user', ['user' => $user, 'me'=> $me]);
        }
    else {
        //aja baja!
        return View::make('ajabaja');

    }
    }

    function add(Request $request) {
        $user = User::factory()->make($request->request->all());
        $this->repo->add($user);
        return redirect('/anvandare');
    }

    public function modifyUser(Request $request) {
        $id = $request->route('id');
        if ($request->request->get('delete')) {
            $this->repo->delete($id);
        }
        else {
            $user = $this->repo->get($id);
            $user->fill($request->request->all());
            $this->repo->update($user);
        }
        return redirect('/anvandare');
    }
}