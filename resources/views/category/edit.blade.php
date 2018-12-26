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

<form action="{{ route('category.update',$data->id) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name="title" value="{{ $data->title }}"> 
  </div>
 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection