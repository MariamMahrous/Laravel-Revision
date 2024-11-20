@extends('layouts.app')
@section('content')
<div class="container">
   <div class="alert alert-success" id="success_msg" style="display: none;">
            تم التحديث بنجاح
        </div>

<form   id="offerFormUpdate">
                    @csrf
                    <div class="mb-3">
                    <input type="text" class="form-control" name='id' value="{{$offer->id}}" style="display:none;">
 
    <label for="exampleInputEmail1" class="form-label">{{__('message.photo')}}</label>
    <input type="file" class="form-control" name='photo' aria-describedby="emailHelp">
    @error('photo')
    <small class="form-text text-danger">{{$message}}</small>
 @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.name_ar')}}</label>
    <input type="text" class="form-control" name='name_ar' value="{{$offer->name_ar}}" aria-describedby="emailHelp">
    @error('name_ar')
    <small class="form-text text-danger">{{$message}}</small>
 @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.name_en')}}</label>
    <input type="text" class="form-control" name='name_en'value="{{$offer->name_en}}" aria-describedby="emailHelp">
    @error('name_en')
    <small class="form-text text-danger">{{$message}}</small>
 @enderror
  </div>
 
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.price')}}</label>
    <input type="text" class="form-control" name='price'value="{{$offer->price}}" aria-describedby="emailHelp">
@error('price')
<small class="form-text text-danger">{{$message}}</small>
@enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.details_ar')}}</label>
    <input type="text" class="form-control" name='details_ar' value="{{$offer->details_ar}}" aria-describedby="emailHelp">
   @error('details_ar')
   <small class="form-text text-danger">{{$message}}</small>
   @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__  ('message.details_en')}}</label>
    <input type="text" class="form-control" name='details_en' value="{{$offer->details_en}}" aria-describedby="emailHelp">
   @error('details_en')
   <small class="form-text text-danger">{{$message}}</small>
   @enderror
  </div>
  <button id="update_offer" class="btn btn-primary">{{__('message.save offer')}}</button>
</form>
             
            </div>
        </div>
        </div>
     @stop

@section('scripts')
    <script>

        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();
            var formdata= new FormData($('#offerFormUpdate')[0]);
   $.ajax({
      type:'post',
      enctype:'multipart/form-data',
      url: "{{route('ajax.offers.update')}}",
  
      data:formdata,
      processData:false,
      contentType:false,
      cache:false,
        
  success: function (data) {

                    if (data.status == true) 
                        $('#success_msg').show();
                    


      },
      error:function(reject){

      }
    });
   });
   




    </script>

@stop