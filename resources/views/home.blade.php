@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="mb-4">
                            <a name="" id="" class="btn btn-primary" href="/posts/create" role="button">Post Blog</a>

                    </div> 
                 

                    You are logged in!
                </div>
                   
                {{-- if the number of posts is greater than 0 then display the table --}}
                @if (count($posts)>0)


                <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Title</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($posts as $item)

                            <tr>
                                    <td>
                                            <p>{!!str_limit($item->title, $limit = 60, $end = '.....')!!}</p>

                                    </td>
                                   
                                    <td>
                                        <a name="" id="" class="btn btn-success" href="/posts/{{$item->id}}/edit" role="button">Edit Blog</a></td>
                                    <td>
                                        

                                            {!! Form::model($item, ['route' => ['user.destroy',$item->id],'method'=>'DELETE']) !!}
        
                                            {{Form::submit('Delete blog', ['class' => 'btn btn-danger pull-right'])}}
                                
                                            {!! Form::close() !!}

                                    </td>
                            </tr>
                                
                            @endforeach
                         
                        
                        </tbody>
                      </table>
                      @else
                         
                      <h2 class="text-center">You have no Blog Posts</h2>
                    
                      @endif

            
                    
               

              
            </div>
        </div>
    </div>
</div>
@endsection
