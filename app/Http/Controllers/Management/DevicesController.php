<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DevicesController extends Controller
{
    public function index(){
        $device = \DB::table('device_types')->get();
        $transPoint = \DB::table('transaction_point')->select('trans_point_id','trans_point_name')->get();
        return view('devices',compact('transPoint','device'));
    }    

    public function getAllDevices(){
        $sqlQuery = "SELECT * FROM devices JOIN device_types ON devices.device_type_id = device_types.device_type_id";
        $getDevices = \DB::select(\DB::raw($sqlQuery));                     
        return $getDevices;
    }

    public function addDevice(Request $request){
        //Set uiid for account
        $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );  
        $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
        $t=time();
        $apiKey = md5($randomString - $t);

        $addDevice = \DB::table('devices')->insertGetId(
            array('device_id' => $uuid, 'device_name' => $request->deviceName, 'api_key' => $apiKey, 'device_type_id' => $request->deviceTypeId)
        );        
        return "Ok";
    }

    public function getDevice(Request $request){
        $sqlQuery = "SELECT * FROM devices JOIN device_types ON devices.device_type_id = device_types.device_type_id WHERE device_id = '".$request->deviceId."'";
        $getDevice = \DB::select(\DB::raw($sqlQuery));                     
        return $getDevice;             
    }

    public function editDevice(Request $request){
        $editDevice = \DB::table('devices')->where('device_id','=', $request->deviceId)->update(
            array('device_name' => $request->deviceName, 'device_type_id' => $request->deviceTypeId)
        );
        return "Ok";
    }

    public function delDevice(Request $request){
        $del = \DB::table('devices')->where('device_id', '=', $request->deviceId)->delete();
        return "Ok";
    }
}
