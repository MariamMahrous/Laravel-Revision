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
      <th scope="col">{{__('message.name offer')}}</th>
      <th scope="col">{{__('message.price all')}}</th>
      <th scope="col">{{__('message.details offer')}}</th>
      <th scope="col">{{__('message.offer photo')}}</th>
      <th scope="col">{{__('message.operation')}}</th>

      
    </tr>
  </thead>
  <tbody>
    @foreach($offers as $offer)
    <tr class="offerRaw{{$offer->id}}">
      <th scope="row">{{$offer->id}}</th>
      <td>{{$offer->name}}</td>
      <td>{{$offer->price}}</td>
      <td>{{$offer->details}}</td>
      <td><img style="width:20px;height:20px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
      <td><a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success">{{__('message.offer_update')}}</a>
      <a href="{{url('offers/delete/'.$offer->id)}}" class="btn btn-danger">{{__('message.offer_delete')}}</a>
      <a href=""  offer_id="{{$offer->id}}"      class="delete_btn btn btn-danger">حذف اجاكس</a>
      <a href="{{route('ajax.offers.edit',$offer_id->id)}}"  offer_id="{{$offer->id}}" id="#update_btn"     class="btn btn-danger">تعديل اجاكس</a></td>

    </tr>
   @endforeach
  </tbody>
</table>
</div>
@stop

@section('scripts')
    <script>
      
      $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
            var offer_id= $(this).attr('offer_id');
   $.ajax({
      type:'post',
      enctype:'multipart/form-data',
      url: "{{route('ajax.offers.delete')}}",
  
      data:{
        "_token":"{{csrf_token()}}",
        "id":offer_id,
      },
    
        
  success: function (data) {

                    if (data.status == true) 
                   {     $('#success_msg').show();
                    }
           $('.offerRaw'+data.id).remove();

      },
      error:function(reject){

      }
    });
   });
   



    </script>

@stop