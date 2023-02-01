<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
        <h1>Add Your Offer</h1>

        @if(Session::has('success'));
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
        @endif

        <form method="post" action="{{url('offers\store')}}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Offer Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                @error('name')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Offer Price</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="price">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Offer details</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="details">
                @error('details')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
</body>
</html>
