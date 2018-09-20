<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainScreenController extends Controller  
{
    public function index(){        
        return view('config.mainscreen');
    }
}