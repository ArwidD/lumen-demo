<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ColorController extends Controller
{
    public function show(Request $request)
    {
        $bakgrund = $request->get('back');
        $text = $request->get('front');
        return View::make('farger',['backColor' => $bakgrund, 'textColor' => $text]);
    }

    function post(Request $request) {
        $bakgrund = $request->request->get('backColor');
        $text = $request->request->get('textColor');

        return View::make('farger',['backColor' => $bakgrund, 'textColor' => $text]);
    }
    function withParams(Request $request) {
        $bakgrund = $request->route('back');
        $text = $request->route('front');

        return View::make('farger',['backColor' => $bakgrund, 'textColor' => $text]);
    }
}