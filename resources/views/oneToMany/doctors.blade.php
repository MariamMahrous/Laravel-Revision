@extends('layouts.app')
@section('content')
<div class="container">
<div class="alert alert-success" id="success_msg" style="display: none;">
            تم الحذف بنجاح
        </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">title</th>
      <th scope="col">Operation</th>
   
      
    </tr>
  </thead>

  <tbody>
    @if(isset($doctors) &&  $doctors->count() > 0)
  @foreach($doctors as $doctor)
    <tr >
      <th scope="row">{{$doctor->id}}</th>
      <td>{{$doctor->name}}</td>
      <td>{!!$doctor->title !!}</td>
      <td> <a href="{{route('doctors-services', $doctor->id)}}"    class="delete_btn btn btn-success">عرض خدمات الاطباء</a>
</td>
    </tr>
    @endforeach
    @endif
  </tbody>
  

</table>
</div>


@stop
