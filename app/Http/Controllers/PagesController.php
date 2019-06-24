<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
        $title="WELCOME TO THE HOME PAGE";
        return view('pages.index')->with('title',$title);
        
    }

    public function about(){

        $title="I AM THE ABOUT PAGE";
        return view('pages.about')->with('title',$title);
        
    }


    public function services(){
       // $title="I AM THE SERVICES PAGE";
        $data=array(
            'title'=>'I AM THE SERVICES PAGE',
            'header'=>'Services offered',
            'content'=>['web design','programming','game development','computer repair']
        );
        return view('pages.services')->with($data);
    }



}