<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Url;

class EmployeeController extends Controller
{
    public function index(){        
        return view('employee.store'); 
    }
    public function getStore(){
        $apikey = "6358EBEA574E98FF5405B59EF130AA06";            
        $u = new Url;
        header("Content-Type: application/json;charset=UTF-8");
            $url = $u->url.'store';
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
	
    public function getAllEmployee(Request $request){
        $sqlQuery = "SELECT DISTINCT accounts.id, accounts.full_name, accounts.gender, accounts.email, accounts.birthday, accounts.address, accounts.phone, accounts.avatar_url, positions.name, marks 
        FROM `accounts` JOIN store_employee ON accounts.id = store_employee.employee_id JOIN positions ON accounts.position_id = positions.id  LEFT JOIN (Select AVG(marks) as marks, employee_id FROM transactions WHERE marks != 0 
        GROUP BY transactions.employee_id) as T ON accounts.id = T.employee_id WHERE accounts.role_id >= 510 AND store_employee.store_id ='".$request->storeId."'";
        $getAllEmployee = \DB::select(\DB::raw($sqlQuery)); 
        return $getAllEmployee;
    }
	
    public function showAllEmployee(){
        // $emp = \DB::table('accounts')->join('store_employee', 'accounts.id', '=', 'store_employee.employee_id')->where('role_id','>=', 510)->count();
        $right_group = \DB::table('right_groups')->get();
        $position = \DB::table('positions')->select('id','name')->get();  
        $roles = \DB::table('roles')->get();
        return view('employee.employee', compact('emp', 'position','roles', 'right_group'));
    }

    public function addEmployee(Request $request){ 
	if(\Request::ajax()){
			$storeId = $request->addStoreId;
			$avatar_url = url('/').'/storage/upload/accounts/us.png';
            $username = $request->addUsername;
            $password = sha1($request->addPassword);
            $fullname = $request->addFullName;
            $gender = $request->addGender;
            $email = $request->addEmail;
     /*        $bday = explode("/", $request->addBirthday);
			$birthday =  $bday[2]."-".$bday[1]."-".$bday[0]; */
			$birthday = $request->addBirthday;
            $position = $request->addPosition;
            $address = $request->addAddress;
            $phone = $request->addPhone;
            $roleId = $request->addRoleId;
            $rightGroupId = $request->addRightGroup;
			
            $u = new Url; 			
            $fields_string = '{"username":"'.$username.'","password":"'.$password.'", "avatarUrl":"'.$avatar_url.'", "fullName":"'.$fullname.'", "gender":"'.$gender.'", "email":"'.$email.'",
			 "birthday":"'.$birthday.'", "positionId":'.$position.', "address":"'.$address.'", "phone":"'.$phone.'", "roleId": '.$roleId.', "rightGroupId": '.$rightGroupId.', "storeIdList":['.$storeId.']}';                         
            $apikey =$u->api_key;			
            $url = $u->url.'user';
    
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
	
	public function addImageEmployee(Request $request){
		// Get Image Name
        if($request->hasFile('txtUploadImageEmployee')){
            $file = $request->txtUploadImageEmployee;            
            $logo = $file->getClientOriginalName();
            $avatar_url = url('/').'/storage/upload/accounts/'.$logo;
        }else{
            $logo = null;
        }        
        // Move Image to Server
        $file->move(storage_path().'/upload/accounts/', $file->getClientOriginalName());
        // Insert to DB
        $editImage= \DB::table('accounts')->where('id', $request->txtEmployeeId)->update(['avatar_url' => $avatar_url]);
        /* return redirect('get-trans-point');      */
		return redirect()->back();
	}
	
    public function delEmployee(Request $request){
        return \DB::table('accounts')->where('id', '=', $request->employeeId)->delete();        
    }
    
    public function editEmployee(Request $request){
        if (\Request::ajax()) {
            $newPassword = sha1(sha1($request->newPassword));
            $editEmp = \DB::table('accounts')->where('id','=', $request->employeeId)->update(
                array('full_name' => $request->fullName, 'position_id' => $request->position, 'email' => $request->email, 'password' => $newPassword)
            );
            return "Ok";
        }
    }

    public function employeeAttendance(){
        return view('employee.employeeAttendance');
    }

    public function getSummaryEmployee(Request $request){
      
        return view('employee.detail.summary');        
    }

    public function getChartAverageScore(Request $request){
        if (\Request::ajax()) {
            $avgScoreArr = array();
            $sqlQuery = "select MONTH(transactions.reviewed_tst) as month, AVG(marks) as avg from accounts INNER JOIN transactions ON accounts.id = transactions.employee_id where accounts.id = '" . $request->employeeId . "' AND transactions.marks != 0 GROUP BY MONTH(transactions.reviewed_tst)";
            $avgScore = \DB::select(\DB::raw($sqlQuery));
            for ($i = 0; $i < 12; $i++) {
                array_push($avgScoreArr,  0);
                foreach ($avgScore as $value) {
                    if (($i+1) == (int)$value->month) {
                        $avgScoreArr[$i] = (float)$value->avg;
                    }
                }
            }
            return json_encode($avgScoreArr);
        }
    }

    public function getChartTransaction(Request $request){
        if (\Request::ajax()) {
            $avgTransArr = array();
            $sqlQuery = "";
            $avgTrans = \DB::select(\DB::raw($sqlQuery));          
            return $avgTrans;
        }
    }

    public function getInfoEmployee(Request $request){
        if (\Request::ajax()) {
            $sqlQuery = "SELECT * FROM accounts WHERE accounts.role_id = 515 AND accounts.id = '".$request->employeeId."'";
            $employee = \DB::select(\DB::raw($sqlQuery));
        }
        return json_encode($employee);
    }

    public function getTransaction(){
        return view('employee.detail.transaction');
    }

    public function getDataTransaction(Request $request){
        $sqlQuery = "SELECT start_tst, transactions.id, services.name, transactions.process_time, customers.full_name as customerName FROM transactions
         INNER JOIN services ON transactions.service_id = services.id INNER JOIN customers ON transactions.customer_id = customers.id WHERE employee_id = '".$request->employeeId."' 
         AND start_tst >= '".$request->dateFrom."' AND end_tst <= '".$request->dateTo."'";
        $transactionEmployee = \DB::select(\DB::raw($sqlQuery));
        return $transactionEmployee;    
    }

    public function getRating(){
        return view('employee.detail.rating');
    }

    public function getDataRating(Request $request){
        $sqlQuery = "SELECT transactions.start_tst, transactions.id, transactions.marks, transactions.comment, customers.full_name as customerName FROM transactions INNER JOIN customers ON transactions.customer_id = customers.id WHERE employee_id = '".$request->employeeId."' AND marks != 0 AND start_tst >= '".$request->dateFrom."' AND end_tst <= '".$request->dateTo."'";
        $transPoint = \DB::table('stores')->select('id','name')->get();
        $ratingEmployee = \DB::select(\DB::raw($sqlQuery));
        return $ratingEmployee; 
    }

    public function getTransPoint(){
        return view('employee.store');
    }

    public function getAccountManager(){
        $transPoint = \DB::table('stores')->select('id','name')->get();
        $position = \DB::table('positions')->select('id','name')->get();
        return view('employee.detail.accountmanager',compact('transPoint','position'));
    }

    public function getDataAccountManager(Request $request){
        $sqlQuery = "SELECT * FROM accounts WHERE id = '".$request->employeeId."'";
        $account = \DB::select(\DB::raw($sqlQuery));
        return $account;
    }

    public function getTimeWorking(){
        return view('employee.detail.timeworking');
    }

    public function getDataTimeWorking(Request $request){
        $sqlQuery = "SELECT * FROM employee_login WHERE user_id = '".$request->employeeId."' AND start_tst >= '".$request->dateFrom."' AND end_tst <= '".$request->dateTo."'";
        $timeWorking = \DB::select(\DB::raw($sqlQuery));
        return $timeWorking;
    }

    public function getMarkEmployee(Request $request){
        $sqlQuery = "SELECT AVG(marks) as marks FROM transactions WHERE marks != 0 AND transactions.employee_id = '" . $request->employeeId . "'";
        $getSumEmployee = \DB::select(\DB::raw($sqlQuery)); 
        return $getSumEmployee;
    }
}
