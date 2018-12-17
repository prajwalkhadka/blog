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

<form action="{{ route('post.update',$data->id) }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name="title" value="{{ $data->title }}">
    
  </div>
  <div class="form-group">
    <label for="exampleInputBody1">Body</label>
    <textarea name="body" rows="10" cols="20" type="text" class="form-control">
  {{$data->body}}
 </textarea> 

  </div>
   <div class="form-group">
    <label for="exampleInputImage1">Image</label>{{ $data->featured_img }}
   	<input type="file" name="image" id="file" type="form-control">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection