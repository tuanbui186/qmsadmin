<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index(){
        return view('queue');
    }
    
    public function getQueue(){
        $sql = "SELECT transactions.start_tst, temp_ticket.ticket_number, services.service_name, customers.full_name, temp_ticket.status FROM `services` JOIN `transactions` ON services.service_id = transactions.service_id JOIN `temp_ticket` ON temp_ticket.ticket_number = transactions.ticket_number JOIN `customers` ON transactions.customer_id = customers.customer_id";
        return \DB::select(\DB::raw($sql));
    }
}