<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{

    public function __construct()
    {
        //the except attribute specifies the view that should be excluded from the auth middlewares
        $this->middleware('auth',['except' => ['index', 'show']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       //$post= Post::all(); //gets all posts in the Post table

     //  $post= Post::orderBy('created_at', 'desc')->get();

     //including pagination in laravel
       $post= Post::orderBy('created_at', 'desc')->paginate(4);
       //dump( $post);

       // return $post;
        return view('posts.index')->with('posts',$post);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $post=new Post();

        return view('posts.createForm',['post'=>$post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);

        //handle file uploads

        if($request->hasFile('cover_image')){

            //Get  file name with extension
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();

            //Get just fileName
            $fileName=pathinfo( $fileNameWithExt,PATHINFO_FILENAME);//NORMAL PHP CODE


            //Get just Extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            
            $fileNameToStore=$fileName.'_'.time().'.'.$extension; //ensures the images do not overide each other when uploading files

            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);


         }else{

           $fileNameToStore='noimage.jpg';
        }




        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;//takes the id of the currently logged in user
        $post->cover_image = $fileNameToStore;

        $post->save();


        return Redirect::action('PostsController@index')->with('success','Data has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post= Post::find($id); //gets specific post in the Post table

        //dump( $post);
 
       // return $post;
       
        // return view('posts.show')->with('posts',$post);

         return $post;
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post= Post::find($id); //gets specific post in the Post table

        if(auth()->user()->id !==$post->user_id){
             //ensures onnly the correct user can edit the blog content
            //return redirect('/posts')-with()
            return Redirect::action('PostsController@index')->with('error','UnAuthorized page please register or login to access the page');
        }

        return view('posts.edit')->with('post',$post);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        return Redirect::action('PostsController@index')->with('success','Data has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // Post::destroy($id); one line that can be used to destroy the database entry or

       $post=Post::find($id);
       //

       if(auth()->user()->id !==$post->user_id){
        //ensures onnly the correct user can delete the blog content
       //return redirect('/posts')-with()
       return Redirect::action('PostsController@index')->with('error','UnAuthorized page please register or login to access the page');
         }



       if($post->cover_image !='noimage.jpg'){
           //Delete image

           Storage::delete('public/cover_images/'.$post->cover_image);

       }
       
        return Redirect::action('PostsController@index')->with('warning','Data has been Deleted successfully');
    }
}
