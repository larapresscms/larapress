<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;  

    //validation message
    public function setSuccessfullyMessage($message){
        session()->flash('message', $message);
        session()->flash('type','success');
    }
    public function setErrorMessage($message){
        session()->flash('message', $message);
        session()->flash('type','danger');
    }
    
    public function callAction($method, $parameters)
    {
        if (Auth::check() && Auth::user()->email_verified_at === null) {
    
            $path = request()->path();
            $userId = auth()->user()->id;
            $allowedPaths = [
                'dashboard/user/'.$userId.'/edit', 
                'dashboard/profile', 
                'logout',
                'dashboard/user/'.$userId
            ];
    
            if (!in_array($path, $allowedPaths)) {
                $this->setErrorMessage('Please change your password.');
                return redirect('/dashboard/user/'.auth()->user()->id.'/edit');
            }
    
            
        }
    
        return parent::callAction($method, $parameters);
    }
    
    
}
