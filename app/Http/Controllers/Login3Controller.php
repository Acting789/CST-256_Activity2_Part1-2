<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\Business\SecurityService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

class Login3Controller extends Controller
{
    //BSET PRATICE:  name your methoods properly and clearly (index() is preaty bad for contoller from POST)
    public function index(Request $request){
        try {
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
                return view('loginPassed3')->with($data);
            } else {
                return view('loginFailed3');
            }
        } catch (ValidationException $e1){
            throw $e1;
        } catch (Exception $e2){
            return view("systemException");
        } 
    }
    
    private function validateform(Request $request){
        //BSET PRATICE: centralise your rules so you have a constent architecture and even reuse your rules
        //BAD PRATEICE:  not using a defined data validationg framework, putting tules all over your own code, doing only client side or database setup validation rules for login form
        $rules = ['username' => 'Required | between:4,10 | Alpha', 'password' => 'Required | Between:4,10'];
        
        //Run data Validation Rules
        $this->validate($request, $rules);
        
    }
}
