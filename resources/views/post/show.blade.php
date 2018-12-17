@extends('layouts.main')
@section('content')
<div class="container">
  <div class="row">
    <h1>{{ $data->title }}</h1>
  </div>
  <div class="row">
    <img src="{{ asset('images/'.$data->featured_img)}}" >
  </div>
  <div class="row">
    <p>{{ $data->body }}</p>
  </div>

</div>
@endsection