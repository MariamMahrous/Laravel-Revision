@extends('layouts.app')
@section('content')
<div class="container">
   <div class="alert alert-success" id="success_msg" style="display: none;">
            تم الحفظ بنجاح
        </div>

<form   id="offerForm">
                    @csrf
                    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.photo')}}</label>
    <input type="file" class="form-control" name='photo' aria-describedby="emailHelp">
   
    <small id="photo_error" class="form-text text-danger"></small>

  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.name_ar')}}</label>
    <input type="text" class="form-control" name='name_ar' aria-describedby="emailHelp">
    <small id="name_ar_error" class="form-text text-danger"></small>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.name_en')}}</label>
    <input type="text" class="form-control" name='name_en' aria-describedby="emailHelp">
    <small id="name_en_error" class="form-text text-danger"></small>
  </div>
 
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.price')}}</label>
    <input type="text" class="form-control" name='price' aria-describedby="emailHelp">
    <small id="price_error" class="form-text text-danger"></small>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__('message.details_ar')}}</label>
    <input type="text" class="form-control" name='details_ar' aria-describedby="emailHelp">
    <small id="details_ar_error" class="form-text text-danger"></small>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">{{__  ('message.details_en')}}</label>
    <input type="text" class="form-control" name='details_en' aria-describedby="emailHelp">
    <small id="details_en_error" class="form-text text-danger"></small>
  </div>
  <button id="save_offer" class="btn btn-primary">{{__('message.save offer')}}</button>
</form>
             
            </div>
        </div>
        </div>
     @stop

@section('scripts')
    <script>

        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
           $('#photo_error').text('');
           $('#name_ar_error').text('');
           $('#name_en_error').text('');
           $('#price_error').text('');
           $('#details_ar_error').text('');
           $('#details_en_error').text('');









            var formdata= new FormData($('#offerForm')[0]);
   $.ajax({
      type:'post',
      enctype:'multipart/form-data',
      url: "{{route('ajax.offers.store')}}",
  
      data:formdata,
      processData:false,
      contentType:false,
      cache:false,
        
  success: function (data) {

                    if (data.status == true) 
                        $('#success_msg').show();
                    


      },
      error:function(reject){
      var response = $.parseJSON(reject.responseText);
      $.each(response.errors,function(key,val){
  $("#"+ key +"_error").text(val[0]);
      });

      }
    });
   });
   




    </script>

@stop