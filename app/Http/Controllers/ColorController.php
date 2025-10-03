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
        //ta in rutt-parametrar
        $bakgrund = $request->route('back');
        $text = $request->route('front');

        //om det finns gäller query-parametrar istället
        $bakgrund = $request->get('back', $bakgrund);
        $text = $request->get('front', $text);
        return View::make('farger',['backColor' => $bakgrund, 'textColor' => $text]);
    }
}