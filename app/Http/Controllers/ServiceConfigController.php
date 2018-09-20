<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Url;

class ServiceConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(){     
        $stores = \DB::table('stores')->select('id','name')->get();           
        return view('serviceconfig', compact('stores'));
    }

    public function showServices(){         
        $u = new Url;
        $apikey = $u->api_key;   
        header("Content-Type: application/json;charset=UTF-8");
            $url = $u->url.'service';
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
    public function addServiceOfStore(Request $request){ 
        if(\Request::ajax()){
            $storeId = \Request::input('storeId');
            $serviceId = \Request::input('serviceId');
            $initSeq = \Request::input('initSeq');
            $maxSeq = \Request::input('maxSeq');                        
            
            $u = new Url;
            $apikey =$u->api_key;
            $fields_string = '{"serviceId":"'.$serviceId.'","initSeq":'.$initSeq.',"maxSeq":'.$maxSeq.'}';                   
            header("Content-Type: text/plain; charset=UTF-8");
            $url = $u->url.'store/addServiceOfStore/'.$request->storeId;     
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
    public function getService(Request $request){
        $u = new Url;
        $apikey = $u->api_key;   
        header("Content-Type: application/json;charset=UTF-8");
            $url = $u->url.'service/'.$request->serviceId;
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

    public function editService(Request $request){        
        if(\Request::ajax()){
            $serviceId = \Request::input('editServiceId');
            $serviceName = \Request::input('editServiceName');
            $defaultInitSeq = \Request::input('editInitSeq');
            $defaultMaxSeq = \Request::input('editMaxSeq');     
            $editLogoUrl = \Request::input('editLogoUrl');
            $fields_string = '{"name":"'.$serviceName.'","logoUrl":"'.$editLogoUrl.'", "defaultInitSeq":"'.$defaultInitSeq.'", "defaultMaxSeq":"'.$defaultMaxSeq.'"}';
            $u = new Url;
            $apikey =$u->api_key;                    
            $url = $u->url.'service/'.$serviceId;
     
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

    public function editImageService(Request $request){
        if($request->hasFile('txtUploadImage')){
            $file = $request->txtUploadImage;
            $logo = $file->getClientOriginalName();            
            $file->move(storage_path().'/upload/services', $logo);
        }else{
            $logo = null;
        }        
        $logo_url = url('/').'/storage/upload/services/'.$logo;

        $editImageService = \DB::table('services')->where('id','=', $request->txtServiceId)->update(
            array( 'logo_url' => $logo_url,)
        );
        return redirect('service-config');
    }

    public function getServiceNotInStore(Request $request){
        $u = new Url;
        $apikey = $u->api_key;   
        header("Content-Type: application/json;charset=UTF-8");
            $url = $u->url.'service/getServicesNotInStore/'.$request->storeId;
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

    public function getServiceOfStore(Request $request){
        $u = new Url;
        $apikey = $u->api_key;   
        header("Content-Type: application/json;charset=UTF-8");
            $url = $u->url.'service/getServicesOfStore/'.$request->storeId;
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

    public function createService(Request $request){
        if(\Request::ajax()){
            $name = $request->serviceName;
            $initSeq = $request->initSeq;
            $maxSeq = $request->maxSeq;                        
            $logoUrl = url('/').'/storage/upload/services/service.jpeg';
            $u = new Url;
            $apikey =$u->api_key;
            $fields_string = '{"name":"'.$name.'","defaultInitSeq":'.$initSeq.',"defaultMaxSeq":'.$maxSeq.', "logoUrl":"'.$logoUrl.'"}';                   
            $url = $u->url.'service';     
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

    public function createServiceOfStore(Request $request){
        if(\Request::ajax()){
            $storeId = $request->storeId;
            $name = $request->serviceName;
            $initSeq = $request->initSeq;
            $maxSeq = $request->maxSeq;    
            $logoUrl = url('/').'/storage/upload/services/service.jpeg';                                
            $u = new Url;
            $apikey =$u->api_key;
            $fields_string = '{"name":"'.$name.'","initSeq":'.$initSeq.',"maxSeq":'.$maxSeq.', "logoUrl":"'.$logoUrl.'"}';                               
            $url = $u->url.'store/addNewServiceOfStore/'.$request->storeId;     
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

    public function deleteService(Request $request){
        if(\Request::ajax()){            
            $serviceId = $request->serviceId;
            $u = new Url;
            $apikey =$u->api_key;
            $fields_string = '["'.$serviceId.'"]';              
            $url = $u->url.'service';
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

    public function deleteServiceOfStore(Request $request){     
        if(\Request::ajax()){            
            $serviceId = $request->serviceId;
            $u = new Url;
            $apikey =$u->api_key;
            $fields_string = '{"serviceId":"'.$serviceId.'"}';              
            $url = $u->url.'store/deleteServiceOfStore/'.$request->storeId;
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