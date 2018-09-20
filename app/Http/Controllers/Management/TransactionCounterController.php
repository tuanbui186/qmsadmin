<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Url; 
class TransactionCounterController extends Controller
{
    public function index(){
        $service = \DB::table('services')->get();
        $transPoint = \DB::table('stores')->select('id','name')->get();
        $devices = \DB::table('devices')->select('id','name')->get();
        return view('transactioncounters',compact('transPoint','service','devices'));
    }    

    public function getAllTransactionCounters(){
        // $sqlQuery = "SELECT * FROM counters JOIN counter_service ON counters.id = counter_service.counter_id JOIN services ON counter_service.service_id = services.id";
        // $getCounterService = \DB::select(\DB::raw($sqlQuery));             
        
        // $sqlQuery = "SELECT * FROM counters";
        // $getCounter = \DB::select(\DB::raw($sqlQuery));
        // $array = [];  
        // $arrServiceList = [];        
        
        // if(sizeOf($getCounterService) > 0){
        //     foreach ($getCounter as $key => $val){                
        //         $arrServiceList=array();                 
        //         foreach ($getCounterService as $key2 => $val2){                    
        //             if($val2->counter_id == $val->id){                                                                 
        //                 array_push($arrServiceList, ['service_id'=> $val2->id, 'service_name' => $val2->name]);
        //             }
        //         }                
        //         array_push($array,["counter_id" => $val->id, "counter_name" => $val->name, "counter_seq" => $val->seq, "status" => $val->status, "service_list" => $arrServiceList ]);
        //     }      
        // }
        //  return $array;
        if(\Request::ajax()){
                $u = new Url;
                $apikey =$u->api_key;
                $url = $u->url.'counter';
                header("Content-Type: application/json;charset=UTF-8");              
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL,
                    $url
                );
                $header = ['API_KEY:'.$apikey];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                $arr = curl_exec($ch);
           }
           return $arr;
    }

    public function addTransactionCounter(){
        //Set uiid for account
        // $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        // mt_rand(0, 0xffff),
        // mt_rand(0, 0x0fff) | 0x4000,
        // mt_rand(0, 0x3fff) | 0x8000,
        // mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        // );  

        // $addCounter = \DB::table('counters')->insertGetId(
        //     array('counter_id' => $uuid, 'counter_name' => $request->counterName, 'counter_seq' => $request->counterSeq, 'status' => $request->statusCounter)
        // );
        // foreach ($request->sltServiceList as $service) {
        //     $addService = \DB::table('counter_service')->insertGetId(
        //         array('counter_id' => $uuid, 'service_id' => $service)
        //     );
        // }
        // return "Ok";
        if(\Request::ajax()){
            $addCounterName = \Request::input('addCounterName');
            // $addDevice = \Request::input('addDevice');
            $addCounterSeq = \Request::input('addCounterSeq');
            // $addStatusCounter = \Request::input('addStatusCounter');
            $addServiceList = \Request::input('addServiceList');
            $arrServiceList = implode(", ", $addServiceList);
            $addTransPoint = \Request::input('addTransPoint');
            $u = new Url;
            $apikey =$u->api_key;
            
            $fields_string = '{"name":"'.$addCounterName.'","seq":"'.$addCounterSeq.'", "storeId":"'.$addTransPoint.'","serviceIdList":['.$arrServiceList.']}'; 
            $url = $u->url.'counter';
     
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($ch, CURLOPT_POST,           1 );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_URL, $url);
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

    public function getTransactionCounter(Request $request){
        if(\Request::ajax()){
            $u = new Url;
            $apikey =$u->api_key;
            $url = $u->url.'counter/'.$request->counterId;
            header("Content-Type: application/json;charset=UTF-8");              
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,
                $url
            );
            $header = ['API_KEY:'.$apikey];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $arr = curl_exec($ch);
       }
       return $arr;
    }

    public function editTransactionCounter(){   
        if(\Request::ajax()){
            $counterId = \Request::input('counterId');
            $counterName = \Request::input('counterName');
            $deviceId = \Request::input('deviceId');
            $counterSeq = \Request::input('counterSeq');
            $statusCounter = \Request::input('statusCounter');
            $sltServiceList = \Request::input('sltServiceList');
            $serviceIdList = implode(", ", $sltServiceList);
            $storeId = \Request::input('storeId');

            $fields_string = '{"deviceId":"'.$deviceId.'", "id":"'.$counterId.'", "name":"'.$counterName.'", "seq":"'.$counterSeq.'", "status":"'.$statusCounter.'", "storeId":"'.$storeId.'", "serviceIdList":['.$serviceIdList.']}';
            $u = new Url;
            $apikey =$u->api_key;                    
            $url = $u->url.'counter/'.$counterId;
     
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_URL,
                $url
            );
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

    public function delTransactionCounter(Request $request){
        if(\Request::ajax()){
            $counterId = \Request::input('counterId');
            $u = new Url;
            $apikey =$u->api_key;
            $fields_string = '["'.$counterId.'"]';            
            $url = $u->url.'counter';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_URL, $url);
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
