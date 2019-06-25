@extends('layouts.App')

@section('content')
<h1>{{$title}}</h1>
<h3>{{$header}}</h3>

@if (count($content)>0)
<ul>
    @foreach ($content as $item)

    <li class="list-group-item">{{$item}}</li>
        
    @endforeach
</ul>  
@endif


<p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis illum reprehenderit, eos distinctio consectetur quisquam sequi 
    voluptatum obcaecati magni delectus praesentium amet saepe corporis suscipit aut sit rem, impedit soluta!
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci facilis dicta quas blanditiis impedit, accusantium ipsa voluptate accusamus 
    fugiat quisquam, laboriosam, deleniti corrupti eligendi tempore quam cum dolorum cupiditate unde!
</p>
@endsection

    



