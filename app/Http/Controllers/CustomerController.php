<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Url;

class CustomerController extends Controller
{
    public function index(){
        return view('customer');
    }
    
    public function getCustomer(Request $request){                
        $u = new Url;
        $apikey = $u->api_key;   
        header("Content-Type: application/json;charset=UTF-8");
            $url = $u->url.'customer';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL,
                    $url
                );
                $header = ['API_KEY:'.$apikey];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $arr = curl_exec($ch);
        return $arr;
    }
    public function addCustomer(Request $request){
        if(\Request::ajax()){
            $addFullname = $request->addFullname;
            $addPhone = $request->addPhone;
            $addGender = $request->addGender;                                  
            $addPassword = sha1($request->addPassword);     
            $addEmail = $request->addEmail;                    
            $addPoint = $request->addPoint;            
            $addBirthday = $request->addBirthday;   
            $u = new Url;
            $apikey =$u->api_key;
            $fields_string = '{"fullName":"'.$addFullname.'","phone":"'.$addPhone.'","gender":"'.$addGender.'","password":"'.$addPassword.'","email":"'.$addEmail.'","point":"'.$addPoint.'", "birthday":"'.$addBirthday.'"}';                               
            $url = $u->url.'customer/createCustomer';     
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($ch, CURLOPT_POST,           1 );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_URL,$url);
            $headers = array(
                  'Content-type: application/json',
                  'charset=UTF-8',
                  'API_KEY:'.$apikey,
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $obj = curl_exec($ch);
        }
        return $obj;
    }
}
