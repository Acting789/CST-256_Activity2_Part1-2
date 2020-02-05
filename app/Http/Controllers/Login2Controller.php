<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\Business\SecurityService;
use Illuminate\Http\Request;

class Login2Controller extends Controller
{
    //BSET PRATICE:  name your methoods properly and clearly (index() is preaty bad for contoller from POST)
    public function index(Request $request){
        
        //Display the form data
        $username = $request->input('username');
        $password = $request->input('password');
        
        //save posted form data in user object model
        $user = new UserModel($username, $password);
        
        //call security business service
        //BEST PRATICE: pass course granied not fine graned paramters
        $service = new SecurityService();
        $status = $service->login($user);
        
        //render a faild or success respopnce view and pass the user model to it
        if($status){
            $data = ['model' => $user];
            return view('loginPassed2')->with($data);
        } else {
            return view('loginFailed2');
        }
        
    }
}
