<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
