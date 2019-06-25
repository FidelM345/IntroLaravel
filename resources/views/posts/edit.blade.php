@extends('layouts.App')

@section('content')


<div class="mt-5">
        
        <h3 >Post blogs to site</h3>
        <hr class="mb-5">

         {!! Form::model($post, ['action' => ['PostsController@update',$post->id],'method'=>'PUT','class' =>'was-validated']) !!}
        
             <div class="form-group">
                {!! Form::label('title', 'Blog Title:',['class' => 'h4']) !!}
                {!! Form::text('title',$post->title, ['class' => 'form-control','required'=>'required','placeholder'=>'Blog Title']) !!}
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
             </div>


              <div class="form-group">
                    {!! Form::label('body', 'Blog Content:',['class' => 'h4']) !!}
                    {!! Form::textarea('body',$post->body, ['id'=>'article-ckeditor','class' => 'form-control','required'=>'required','placeholder'=>'Type blog here....']) !!}
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>
              </div>


             {{-- {!! Form::hidden('_method','PUT') !!} --}}

             <div class="form-group"> 

                {{-- for a normal button --}}
                {{-- {{Form::button('Open Image', ['class' => 'btn btn-large btn-primary openbutton'])}} --}}

                {{-- for a submit button --}}
                    {{Form::submit('Submit your blog', ['class' => 'btn btn-primary btn-lg btn-block'])}}
        
             </div>
          
           {!! Form::close() !!}

        {{-- <form action="/action_page.php" class="was-validated">
            <div class="form-group">
              <label for="uname"><h4>Blog Title:</h4></label>
              <input type="text" class="form-control" id="uname" placeholder="Enter Blog Tilte" name="uname" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
              <label for=""><h4>Blog Content:</h4></label>
              <textarea class="form-control" name="" id="" rows="3" placeholder="Enter Blog Contents" required></textarea>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form> --}}

</div>

    
@endsection
