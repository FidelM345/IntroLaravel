<?php

namespace App\Http\Controllers\test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



//use Illuminate\Http\Request;
use App\Http\Requests;//laravel class for http requests
use  Symfony\Component\HttpFoundation\Response;



use App\Article;
use App\Http\Resources\Article as ArticleResource;

// Add this line
use Unlu\Laravel\Api\QueryBuilder;



class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {


        // $queryBuilder = new QueryBuilder(new Article, $request);
    
        // return response()->json([
        //       'data' => $queryBuilder->build()->paginate(),
    
        // ]);



        try {

          //Get list of Articles
        $articles=Article::paginate(15);

        //Returns collection of articles as resource
        return ArticleResource::collection($articles);


        } catch (\Throwable $th) {
            return response([
                 'status'=>' failed',
                 'message'=>'resource not found'
               
            ],Response::HTTP_NOT_FOUND);
        }
       


        

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
        // $article=$request->isMethod('put')?
        //                                   Article::findOrFail($id): new Article();

       // $article->id=$request->article_id;

       $request->validate([
        'title' => 'required',
        'body' => 'required',
        ]);

    


    $article=new Article();
    $article->title=$request->title;
    $article->body=$request->body;

    if($article->save()){
       // return new ArticleResource($article);

       return response(
           [
               'status'=>'OK',
               'results'=>new ArticleResource($article)
           ],Response::HTTP_CREATED

       );
    }



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

        try {

            $article=Article::findOrFail($id);

            return new ArticleResource($article);

        } catch (\Throwable $th) {
            return response([
                 'status'=>' failed',
                 'message'=>'resource not found'
               
            ],Response::HTTP_NOT_FOUND);
        }


        
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

        $article=Article::findOrFail($id);

        // $article->id=$request->article_id;
        $article->title=$request->title;
        $article->body=$request->body;

        if($article->save()){
            return new ArticleResource($article);
        }


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

        try {
            $article=Article::findOrFail($id);

            if($article->delete()){
                return response([
                    'status'=>'OK',
                     'deleted_data'=>new ArticleResource($article)

                ],Response::HTTP_ACCEPTED);
            }
        } catch (\Throwable $th) {
            return response([
                 'status'=>' failed',
                 'message'=>'resource not found'
               
            ],Response::HTTP_NOT_FOUND);
        }
       

    }
}
