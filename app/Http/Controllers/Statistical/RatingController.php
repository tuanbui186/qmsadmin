<?php

namespace App\Http\Controllers\Statistical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function index(){
        return view('statistical.rating');
    } 

    public function getRating(){
        return \DB::table('transactions')
        ->join('customers', 'customers.id', '=' , 'transactions.customer_id')
        ->select('transactions.id', 'customers.id as customerId', 'marks','full_name', 'comment', 'reviewed_tst')->whereNotNull('marks')->whereNotNull('comment')->get();
    }
}