@extends('layouts.App')

@section('content')


<div class="mt-5">
        
        <h3 >Post blogs to site</h3>
        <hr class="mb-5">

         {!! Form::model($post, ['action' => 'PostsController@store','method'=>'POST','class' =>'was-validated','enctype'=>'multipart/form-data']) !!}
        
             <div class="form-group">
                {!! Form::label('title', 'Blog Title:',['class' => 'h4']) !!}
                {!! Form::text('title', '', ['class' => 'form-control','required'=>'required','placeholder'=>'Blog Title']) !!}
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>

              </div>

              <div class="form-group">
                    {!! Form::label('body', 'Blog Content:',['class' => 'h4']) !!}
                    {!! Form::textarea('body', '', ['id'=>'article-ckeditor','class' => 'form-control','required'=>'required','placeholder'=>'Type blog here....']) !!}
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>

             </div>

             <div class="form-group">
                <label for="">FireBase file upload</label>
                <progress value="0" max="100" id="uploader">0%</progress>
	              <input type="file" value="upload" accept=".jpg" id="fileButton">
             
             </div>
             
             

             {{-- <div class="form-group">
               normal file upload field
                {{Form::file('cover_image')}}

             </div> --}}



             <div class="form-group">
               
                 {{ Form::hidden('firebase_url', '', array('id' => 'firebase_url')) }}

             </div>


             <div class="form-group"> 

                {{-- for a normal button --}}
                {{-- {{Form::button('Open Image', ['class' => 'btn btn-large btn-primary openbutton'])}} --}}

                {{-- for a submit button --}}

                    {{Form::submit('Submit your blog', ['class' => 'btn btn-primary btn-lg btn-block'])}}
      
             </div>
          
           {!! Form::close() !!}




           <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   

           <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase.js"></script>
           
           <script>
       
           //BE SURE TO PROTECT EVERYTHING IN THE CONFIG
           //DON'T COMMIT IT!!!
       
           // Initialize Firebase
           var config = {
             apiKey: "AIzaSyCCzyXJAJlYngad1RzYI7F9a5NZ58DpFyQ",
             authDomain: "myprojo-be85d.firebaseapp.com",
             databaseURL: "https://myprojo-be85d.firebaseio.com",
             projectId: "myprojo-be85d",
             storageBucket: "myprojo-be85d.appspot.com",
             messagingSenderId: "37419435007"
           };
           firebase.initializeApp(config);
           </script>
       
         <script >
       
           // firebase bucket name
           // REPLACE WITH THE ONE YOU CREATE
           // ALSO CHECK STORAGE RULES IN FIREBASE CONSOLE
           var fbBucketName = 'laravel_images';
       
           // get elements
           var uploader = document.getElementById('uploader');
           var fileButton = document.getElementById('fileButton');
       
           // listen for file selection
           fileButton.addEventListener('change', function (e) {
       
             // what happened
             console.log('file upload event', e);
       


             // get file
             var file = e.target.files[0];
             var date=new Date();//assigns different timestamps to uploaded files
       
             // create a storage ref
             var storageRef = firebase.storage().ref(`${fbBucketName}/${file.name}_${date}`);
      
             // upload file
             var uploadTask = storageRef.put(file);
       
             // The part below is largely copy-pasted from the 'Full Example' section from
             // https://firebase.google.com/docs/storage/web/upload-files
       
             // update progress bar
             uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, // or 'state_changed'
               function (snapshot) {
                 // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                 var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                 uploader.value = progress;
                 console.log('Upload is ' + progress + '% done');
                 switch (snapshot.state) {
                   case firebase.storage.TaskState.PAUSED: // or 'paused'
                     console.log('Upload is paused');
                     break;
                   case firebase.storage.TaskState.RUNNING: // or 'running'
                     console.log('Upload is running');
                     break;
                 }
               }, function (error) {
       
                 // A full list of error codes is available at
                 // https://firebase.google.com/docs/storage/web/handle-errors
                 switch (error.code) {
                   case 'storage/unauthorized':
                     // User doesn't have permission to access the object
                     break;
       
                   case 'storage/canceled':
                     // User canceled the upload
                     break;
       
                   case 'storage/unknown':
                     // Unknown error occurred, inspect error.serverResponse
                     break;
                 }
               }, function () {
                 // Upload completed successfully, now we can get the download URL
                 // save this link somewhere, e.g. put it in an input field
                  swal("Good job!", "Image saved successfully", "success");
                  var downloadURL = uploadTask.snapshot.downloadURL;
                  var element = document.getElementById("firebase_url");
                  element.value = downloadURL;
                  element.forms.submit();
                  console.log('downloadURL', downloadURL);


               });
       
           });
       
       
         </script>

      





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
