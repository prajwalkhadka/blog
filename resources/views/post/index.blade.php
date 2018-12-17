@extends('layouts.main')
@section('content')
<div class="containet">
<table class="table">
  <thead>
    <tr>
      <th scope="col">sn</th>
      <th scope="col">title</th>
      <th scope="col">body</th>
      <th scope="col">image</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $key=>$da)
    <tr>
      <th scope="row">{{ ++$key }}</th>
      <td>{{ $da->title }}</td>
      <td>{{ $da->body }}</td>
      <td><img src="{{ asset('/images/'.$da->featured_img) }}" style="height: 50px; width: 50px;"></td>
      <td>
          <a href="{{ route('post.show',$da->id) }}"><input type="button" class="btn btn-primary" name="" value="view"></a>
          
          <a href="{{ route('post.edit',$da->id) }}"><input type="button" class="btn btn-primary" name="" value="edit"></a>
         
          <form action="{{ route('post.delete',$da->id) }}" method="post">
            <input name="_method" type="hidden" value="delete">
            @csrf
          <input type="submit" class="btn btn-danger" name="" value="delete">
          </form>
      </td>
    </tr>
   @endforeach
  </tbody>
</table>
</div>
@endsection