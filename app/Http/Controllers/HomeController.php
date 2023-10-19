<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class HomeController extends Controller
{

    
    public function index(){
        return response()->json([
            'message' => 'Api Online'
        ]);
    }
}
