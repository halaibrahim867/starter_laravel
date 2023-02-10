@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
            updated successfully
        </div>

        <div class="title m-b-md">
            <h1>
                {{__('messages.Edit Your Offer')}}
            </h1>
        </div>

        <form method="post" id="offerFormUpdate" action="">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__("messages.Offer Name ar")}}</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name_ar" value="{{$offer -> name_ar}}" placeholder="{{__('messages.Enter offer name ar')}}">
                @error('name_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <input type="text" style="display: none;" class="form-control" value="{{$offer -> id}}" name="offer_id">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__("messages.Offer Name en")}}</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name_en" value="{{$offer->name_en}}" placeholder="{{__('messages.Enter offer name en')}}">
                @error('name_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Price')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="price" value="{{$offer->price}}" placeholder="{{__("messages.Enter offer price")}}">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="details_ar" value="{{$offer->details_ar}}" placeholder="{{__('messages.Enter offer details ar')}}">
                @error('details_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="details_en" value="{{$offer->details_en}}" placeholder="{{__('messages.Enter offer details en')}}">
                @error('details_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <button id="update_offer" class="btn btn-primary">{{__('messages.Save')}}</button>
        </form>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click','#update_offer',function(e){
            e.preventDefault();

            let formData =new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type: 'post',
                enctype:'multipart/form-data',
                url:"{{route('ajax.offers.update')}}",
                data :formData,
                processData:false,
                contentType: false,
                cache: false,
                success : function (data){
                    if(data.status == true){
                        ($("#success_msg")).show();
                    }

                }, error: function (reject){

                }
            });
        });

    </script>
@endsection
