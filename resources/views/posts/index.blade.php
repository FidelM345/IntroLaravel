@extends('layouts.App')
<!-- Example row of columns -->

@section('content')
<div >
      <div class="row ">

            <div class=" mt-5">
                <h2>Blog Posts</h2>
                <hr>
                @if (count($posts)>0)
        
                @foreach ($posts as $item)
                
                        <div class="card card-body bg-light mt-2">
                           <div class="row col-md-12">


                                 <div class="col-md-4">

                                       <img src="/storage/cover_images/{{$item->cover_image}}" alt="No image" style="width:100%">
         
                                    </div>
         
                                    <div class="col-md-8">
         
                                          <h4>{{$item->title}}</h4>
                                          <p>{!!str_limit($item->body, $limit = 350, $end = '.....')!!}</p>
                                          {{-- <p>{{$item->body}}</p> --}}
                                 
                                          {{-- {{ dd($item->user->name)}} --}}
                                 
                                          <p class="mt-2"><b>Posted at: </b>{{$item->created_at}}</p>
                                 
                                          @if ($item->user['name'])
                                 
                                          <p class="mt-2"><b>Author: </b>{{$item->user['name']}}</p>
                                 
                                          @endif
                                 
                                          <p><a class="btn btn-secondary" href="/posts/{{$item->id}}" role="button">Read more&raquo;</a></p>
            
                                    </div>


                           </div>
                           
                     
                        </div>
                  
        
                @endforeach
        
                <div>
                    {{-- used to show pagination --}}
                    {{$posts->links()}}
                </div>
        
        
                @else
        
                <h3>Posts not found</h3>
        
                @endif
        
            </div>
        
        </div>


</div>



@endsection