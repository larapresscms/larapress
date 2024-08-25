<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function __construct()
    // {
    //     dd('test');
    // }

    //validation message
    public function setSuccessfullyMessage($message){
        session()->flash('message', $message);
        session()->flash('type','success');
    }
    public function setErrorMessage($message){
        session()->flash('message', $message);
        session()->flash('type','danger');
    }
}
