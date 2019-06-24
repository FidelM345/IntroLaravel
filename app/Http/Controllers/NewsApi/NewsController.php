<?php

namespace App\Http\Controllers\NewsApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Http\Resources\NewsResource;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        try {

            $post= Post::orderBy('created_at', 'desc')->paginate(5);
            //dump( $post);
     
            // return $post;
             return([
                 'status'=>'OK',
                 'results'=>NewsResource::collection($post)
             ]) ; 
  
  
          } catch (\Throwable $th) {
              return response([
                   'status'=>' failed',
                   'message'=>'resource not found'
                 
              ],Response::HTTP_NOT_FOUND);
          }
         
    }

   
    
}
