<?php

namespace App\Http\Controllers;

use App\Http\ResponseData;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
//use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Helper\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    public $data;
    protected $response_json;

    public function __construct()
    {
        $this->data = array();
        $this->response_json = new ResponseData();
    }

    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    function isPost()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            return true;
        }
        return false;
    }

    function __json($data = null)
    {
        $this->response_json = ($data) ?: $this->response_json;
        return response()->json($this->response_json);
    }
}
