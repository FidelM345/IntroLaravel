@extends('layouts.App')

@section('content')

 <a class="btn btn-secondary mt-4" href="/posts" role="button"> Go back to Posts</a>

<div class="mt-4">

         <img src="/storage/cover_images/{{$posts->cover_image}}" alt="No image" style="width:100%">
         <br>
         <br>

         <h3>{{$posts->title}}</h3>
         {{-- the double exclamation marks makes it possible to parse html tags --}}
         <p>{!!$posts->body!!}</p>

         @if (!Auth::guest())
               
                  @if (Auth::user()->id==$posts->user_id)

                            <p>
                                <a class="btn btn-primary pull-left" href="/posts/{{$posts->id}}/edit" role="button">Edit Blog</a>
                                
                              
                                  {!! Form::model($posts, ['action' => ['PostsController@destroy',$posts->id],'method'=>'DELETE','class' =>'pull-right']) !!}
                              
                                          {{Form::submit('Delete blog', ['class' => 'btn btn-danger pull-right'])}}
                              
                                 {!! Form::close() !!}
                       
                              
                              </p>
                      
                  @endif
                  
             
         @endif
        

</div>

    
@endsection