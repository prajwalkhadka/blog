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
<form action="{{ action('CategoryController@store') }}" method="post" style="padding: 40px;" >
	@csrf
	
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="exampleInputTitle1" aria-describedby="titleHelp" placeholder="Enter title" name="title">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection