<?php

namespace App\Http\Controllers\test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //


    public function index()
    {
       

        //Returns collection of articles as resource
        return "I am working fine";

    }
}
