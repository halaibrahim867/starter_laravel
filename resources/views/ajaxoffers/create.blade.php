@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display:none">

        </div>
        <div class="flex-center position-ref full-height">
        <div class="title m-b-md">
            <h1>
                {{__('messages.Add Your Offer')}}
            </h1>
        </div>


        @if(Session::has('success'));
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
        @endif
        <br>

        <form method="post" action="" id="offerForm" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__("messages.choose your photo")}}</label>
                <input type="file" class="form-control" id="exampleInputEmail1" name="photo">

                <small id="photo_error"  class="form-text text-danger"></small>

            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__("messages.Offer Name ar")}}</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name_ar" placeholder="{{__('messages.Enter offer name ar')}}">

                <small id="name_ar_error" class="form-text text-danger"></small>

            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__("messages.Offer Name en")}}</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name_en" placeholder="{{__('messages.Enter offer name en')}}">

                <small id="name_en_error" class="form-text text-danger"></small>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Price')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="{{__("messages.Enter offer price")}}">

                <small id="price_error" class="form-text text-danger"></small>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="details_ar" placeholder="{{__('messages.Enter offer details ar')}}">

                <small id="details_ar_error" class="form-text text-danger"></small>

            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="details_en" placeholder="{{__('messages.Enter offer details en')}}">

                <small id="details_en_error" class="form-text text-danger"></small>

            </div>
            <button id="save_offer" class="btn btn-primary">{{__('messages.Save')}}</button>
        </form>

    </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).on('click','#save_offer',function(e){
            e.preventDefault();

            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');

            let formData =new FormData($('#offerForm')[0]);
            $.ajax({
                type: 'post',
                url:"{{route('ajax.offers.store')}}",
                data :formData,
                processData:false,
                contentType: false,
                cache: false,
                success : function (data){
                    if(data.status == true){
                        ($("#success_msg")).show();
                    }

                }, error: function (reject){

                    let response=$.parseJSON(reject.responseText);
                    $.each(response.errors,function (key, val){
                        $("#" + key + "_error").text(val[0]);
                    });

                }
            });
        });

    </script>
@endsection


