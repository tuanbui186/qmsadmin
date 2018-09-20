<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function postLogin(Request $request){
        //if(\Request::ajax()){
            // $username = $request->username;
            // $password = sha1($request->password);
            // if(isset($username) && isset($password)){
            // $results = DB::select( DB::raw("SELECT * FROM accounts WHERE username = '$username'") );               
            // }
            // if($password === $result->password){                
            //     return "ok";
            // }else{
            //     return redirect()->back();
            // }            
        //}        
        return "Ok";
    }
}
