
@if ($errors->any())

        @foreach ($errors->all() as $error)

        <div class="alert alert-danger mt-2">
                {{ $error }}
         </div>
       
        @endforeach 
@endif



@if ($message = Session::get('success'))
<div class="alert alert-success alert-block mt-2">
        <a class="nav-link" href="/posts"> <button type="button" class="close" data-dismiss="alert">×</button></a>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-danger alert-block mt-2">
        <a class="nav-link" href="/posts"> <button type="button" class="close" data-dismiss="alert">×</button></a>
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block mt-2">
        <a class="nav-link" href="/posts"> <button type="button" class="close" data-dismiss="alert">×</button></a>
        <strong>{{ $message }}</strong>
</div>
@endif