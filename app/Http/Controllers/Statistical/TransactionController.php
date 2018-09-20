<?php

namespace App\Http\Controllers\Statistical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index(){
        return view('statistical.transaction');
    } 
    
    public function getTransactions(){
        return \DB::table('transactions')
        ->join('accounts', 'accounts.id', '=', 'transactions.employee_id')
        ->join('customers', 'customers.id', '=' , 'transactions.customer_id')
        ->join('services', 'services.id', '=' , 'transactions.service_id')
        ->join('counters', 'counters.id', '=' , 'transactions.counter_id')
        ->select('transactions.id', 'accounts.full_name as employeeName','accounts.id as employeeId', 'services.name as serviceName', 'customers.full_name as customerName', 'customers.id as customerId', 'counters.name as counterName', 'transactions.ticket_number', 'transactions.phone', 'transactions.start_tst', 'transactions.end_tst', 'transactions.process_time', 'transactions.wait_time')->get();
    }

    public function searchTransactions(){
        return \DB::table('transactions')
            ->where("id",">=",$request->transactionId)                       
            ->get();
    }
}