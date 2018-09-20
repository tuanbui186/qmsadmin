<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transPoint = \DB::table('stores')->select('id','name')->get();
        $services = \DB::table('services')->select('id','name')->get();
        return view('dashboard', compact('transPoint', 'services'));
    }
    public function countTransaction(Request $request){
        if ($request->serviceId == null || $request->serviceId == "" || $request->store == 0){
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)     
            ->count();
        }else{
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)
            ->where("service_id", "=", $request->serviceId)
            ->where("transactions.store_id", "=", $request->store)
            ->count();
        }
    }
    public function countFailTransaction(Request $request){
        if ($request->serviceId == null || $request->serviceId == "" || $request->store == 0){
            return \DB::table('transactions')            
            ->where("transactions.start_tst",">=",$request->dateFrom)
            ->where("transactions.end_tst","<=",$request->dateTo)     
            ->where("transactions.marks","=",0)
            ->count();
        }else{
            return \DB::table('transactions')
            ->where("transactions.start_tst",">=",$request->dateFrom)
            ->where("transactions.end_tst","<=",$request->dateTo)
            ->where("transactions.service_id", "=", $request->serviceId)
            ->where("transactions.marks","=",0)
            ->where("transactions.store_id", "=", $request->store)
            ->count();
        }
    }
    public function countSucessTransaction(Request $request){
        if ($request->serviceId == null || $request->serviceId == "" || $request->store == 0){
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)     
            ->count();
        }else{
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)
            ->where("service_id", "=", $request->serviceId)
            ->where("transactions.store_id", "=", $request->store)
            ->count();
        }
    }
    public function getAverageTimeout(Request $request){
        if ($request->serviceId == null || $request->serviceId == "" || $request->store == 0){
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo) 
            ->avg('wait_time');
        }else{
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)
            ->where("service_id", "=", $request->serviceId)
            ->where("store_id", "=", $request->store)
            ->avg('wait_time');
        }
    }
    public function getAverageScore(Request $request){
        if ($request->serviceId == null || $request->serviceId == "" || $request->store == 0){
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)     
            ->where("marks","!=", 0)    
            ->avg('marks');
        }else{
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)
            ->where("service_id", "=", $request->serviceId)
            ->where("marks","!=", 0)
            ->where("store_id", "=", $request->store)
            ->avg('marks');
        }
    }
    public function getVote(Request $request){
        if ($request->serviceId == null || $request->serviceId == "" || $request->store == 0){
            return \DB::select("SELECT count(*) as count FROM transactions WHERE start_tst >='".$request->dateFrom."' AND end_tst <= '".$request->dateTo."' AND customer_id IS NOT NULL");
        }else{
            return \DB::select("SELECT count(*) as count FROM transactions WHERE start_tst >='".$request->dateFrom."' AND end_tst <= '".$request->dateTo."' AND service_id = '".$request->serviceId."' AND store_id ='".$request->store."' AND customer_id IS NOT NULL");

        }
    }
    public function getAverageServiceTime(Request $request){
        if ($request->serviceId == null || $request->serviceId == "" || $request->store == 0){
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)            
            ->avg('process_time');
        }else{
            return \DB::table('transactions')
            ->where("start_tst",">=",$request->dateFrom)
            ->where("end_tst","<=",$request->dateTo)
            ->where("service_id", "=", $request->serviceId)
            ->avg('process_time');
        }
    }
    public function getTimeServiceChart(){
        if (\Request::ajax()) {
            $timeService = array();
            $sqlQuery = "SELECT AVG(process_time) as avg, MONTH(start_tst) as month FROM `transactions` GROUP BY MONTH(start_tst)";
            $avgTimeService = \DB::select(\DB::raw($sqlQuery));
            for ($i = 0; $i < 12; $i++) {
                array_push($timeService,  0);
                foreach ($avgTimeService as $value) {
                    if (($i+1) == (int)$value->month) {
                        $timeService[$i] = (float)$value->avg;
                    }
                }
            }
        }
        return json_encode($timeService);
    }
    public function getRatioCircleChart(){
        if (\Request::ajax()) {
            $percentsService = array();
            $sqlQuery1 = "SELECT COUNT(transactions.employee_id) AS count, services.name AS name FROM `services` INNER JOIN `transactions` ON services.id = transactions.service_id GROUP BY services.id";
            $countSomeService = \DB::select(\DB::raw($sqlQuery1));

            $sqlQuery2 = "SELECT COUNT(employee_id) as sum FROM `transactions`";
            $countAllService = \DB::select(\DB::raw($sqlQuery2));

            foreach ($countSomeService as $value1){
                foreach ($countAllService as $value2){
                    array_push($percentsService, ["name"=>$value1->name, "y"=>($value1->count/$value2->sum)*100]);
                }
            }
        }
        return json_encode($percentsService);
    }
}