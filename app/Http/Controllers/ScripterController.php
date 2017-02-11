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
            $this->data['id'] = Auth::user()->id;
            $this->data['scripts'] = $scripts;
            $this->data['controller'] = 'dashboard';

            return view('user.index')->with('data', $this->data);
        }
        return Redirect::to('author/login');

    }
}
