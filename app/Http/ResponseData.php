<?php

/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

namespace App\Http;


class ResponseData
{
    public $status;
    public $data;
    public $message;

    public function __construct()
    {
        $this->status = false;
        $this->data = new \stdClass();
        $this->message = '';
    }
}