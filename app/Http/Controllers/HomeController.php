<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Post;

class HomeController extends Controller
{


   

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        


        return view('home')->with('posts',$user->posts);
    }


       /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Post::destroy($id);
        return Redirect::action('HomeController@index')->with('warning','Data has been Deleted successfully');
    }
}
