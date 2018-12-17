@extends('layouts.main')
@section('content')

@if($errors->any())
	<div class="alert.alert-danger">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
<form action="{{ action('PostController@store') }}" method="post" style="padding: 40px;" enctype="multipart/form-data">
	@csrf
	
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="exampleInputTitle1" aria-describedby="titleHelp" placeholder="Enter title" name="title">
  </div>
  <div class="form-group">
    <label for="exampleInputBody1">Body</label>
    <textarea name="body" rows="10" cols="20" type="text" class="form-control" id="exampleInputBody1" placeholder="body" >
 </textarea> 
  </div>
   <div class="form-group">
    <label for="exampleInputImage1">Image</label>
   	<input type="file" name="image" id="file" type="form-control">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection