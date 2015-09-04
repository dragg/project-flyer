<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $user;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();

        view()->share('signedIn', Auth::check());
        view()->share('user', Auth::user());
    }
}
