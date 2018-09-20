<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Url;
class StoresController extends Controller
{
    public function index(){
        $provinces = \DB::table('provinces')->get();
        $service = \DB::table('services')->get();
        $store = \DB::table('stores')->select('id','name')->get();
        return view('stores',compact('provinces','store','service'));
    }    

    public function getAllStores(){
        // $sqlQuery = "SELECT * FROM stores";
        // $getStore = \DB::select(\DB::raw($sqlQuery));             
        
        // return $getStore;
        if(\Request::ajax()){
            $u = new Url;
            $apikey =$u->api_key;
            $url = $u->url.'store';
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

    public function addStore(Request $request){
        if(\Request::ajax()){
            $storeName = \Request::input('storeName');
            $description = \Request::input('description');
            $latitude = \Request::input('latitude');
            $longitude = \Request::input('longitude');
            $districtId = \Request::input('districtId');
            $address = \Request::input('address');
            $phone = \Request::input('phone');
            $fax = \Request::input('fax');
            $openTime = "07:30:00";//\Request::input('openTime');
            $closeTime = "17:00:00";//\Request::input('closeTime');
            $makeAppoint = \Request::input('makeAppoint');  
            $pictureUrl = url('/').'/storage/upload/stores/default-shop-icon.png';
            
            $u = new Url;
            $apikey =$u->api_key;
            $fields_string = '{"name":"'.$storeName.'","description":"'.$description.'","allowBookOnline":"'.$makeAppoint.'", "latitude":"'.$latitude.'",  "longitude":"'.$longitude.'","address":"'.$address.'", "districtId":"'.$districtId.'", "phone":"'.$phone.'", "fax":"'.$fax.'", "closeTime":"'.$closeTime.'", "openTime":"'.$openTime.'", "pictureUrl":"'.$pictureUrl.'"}';                   
            // header("Content-Type: text/plain; charset=UTF-8");
            $url = $u->url.'store';
     
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($ch, CURLOPT_POST,           1 );
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

    public function editImageStore(Request $request){
        // Get Image Name
        if($request->hasFile('txtUploadImageStore')){
            $file = $request->txtUploadImageStore;            
            $logo = $file->getClientOriginalName();
            $picture_url = url('/').'/storage/upload/stores/'.$logo;
        }else{
            $logo = null;
        }
        
        // Move Image to Server
        $file->move(storage_path().'/upload/stores/', $file->getClientOriginalName());
        // Insert to DB
        $editImage= \DB::table('stores')->where('id', $request->txtEditImgStoreId)->update(['picture_url' => $picture_url]);
        return redirect('get-store');     
    }

    public function getStore(Request $request){
        $sqlQuery = "SELECT * FROM stores WHERE id = '".$request->storeId."'";
        $getStore = \DB::select(\DB::raw($sqlQuery));                                    
        return $getStore;
    }

    public function editStore(Request $request){     
        //Edit Store
        $editStore = \DB::table('stores')->where('id','=', $request->txtEditStoreId)->update(
            array('name' => $request->txtEditStoreName, 'description' => $request->txtEditDescription, 'address' => $request->txtEditAddress, 'longitude' => $request->txtEditLongitude, 'latitude' => $request->txtEditLatitude ,'phone' => $request->txtEditPhone, 'fax' => $request->txtEditFax,
            'open_time' => $request->txtEditOpenTime,'close_time' => $request->txtEditCloseTime, 'allow_book_online' => $request->sltEditMakeAppoint)
        );       
        return redirect('get-store');
    }

    public function delStore(Request $request){
        $del = \DB::table('stores')->where('id', '=', $request->storeId)->delete();
        return "Ok";
    }

    public function getDistrict(Request $request){
        if(\Request::ajax()){
            $u = new Url;
            $apikey =$u->api_key;
            $url = $u->url.'/address/getDistrictList/'.$request->provinceId;
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

    public function addWorkTime(Request $request){

    }
}
