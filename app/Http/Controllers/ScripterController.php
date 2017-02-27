<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class ScripterController extends Controller
{
    public function index()
    {
        if (null !== Auth::user()) {
            $styles = array();

            $scripts = array();

            $this->data['styles'] = $styles;
            $this->data['scripts'] = $scripts;
            $this->data['controller'] = 'dashboard';
            $this->data['function'] = '';

            return view('dashboard.index')->with('data', $this->data);
        }
        return Redirect::to('/user/login');

    }
}
