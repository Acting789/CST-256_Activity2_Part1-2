<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsMyNameController extends Controller
{
    public function index(Request $request){
        
        //Display the form data
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        echo "your name is: " . $firstName . " " . $lastName;
        echo "<br>";
        
        //Render a response and view pass from the form data to it
        $data = ['firstName' => $firstName, 'lastName' => $lastName];
        return view('thatswhoiam')->with($data);
    }
}
