@extends('layouts.main')
@section('content')
<div class="containet">
<table class="table">
  <thead>
    <tr>
      <th scope="col">sn</th>
      <th scope="col">title</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $key=>$da)
    <tr>
      <th scope="row">{{ ++$key }}</th>
      <td>{{ $da->title }}</td>
      <td>
          <a href="{{ route('category.show',$da->id) }}"><input type="button" class="btn btn-primary" name="" value="view"></a>
          
          <a href="{{ route('category.edit',$da->id) }}"><input type="button" class="btn btn-primary" name="" value="edit"></a>
         
          <form action="{{ route('category.destroy',$da->id) }}" method="post">
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