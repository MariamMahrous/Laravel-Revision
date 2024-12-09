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
   
   
      
    </tr>
  </thead>

  <tbody>
    @if(isset($services) &&  $services->count() > 0)
  @foreach($services as $service)
    <tr >
      <th scope="row">{{$service->id}}</th>
      <td>{{$service->name}}</td>
     </td>
    </tr>
    @endforeach
    @endif
  </tbody>
  

</table>
</div>


<!-- insert Form SERVICES OF DOCTOR -->
<div class="container">
<form method="POST"  action="{{route('save-doctor-service')}}" >
                    @csrf
                    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">
      اختر اسم الطبيب
    </label>
   <select name="doctor_id">
        @foreach($doctors as $doctor)
    <option value="{{$doctor->id}}">{{$doctor->name}}</option>
    @endforeach
   </select>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">اختر اسم الخدمة</label>
   <select class="form-control" name="services[]" multiple>
   @foreach($allServices as $services)
    <option value="{{$services->id}}">{{$services->name}}</option>
    @endforeach
   </select>
  </div>
  <button type="submit" class="btn btn-primary">حفظ الخدمة</button>
  </form>
  </div>
@stop
