<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @include('layouts.app')
    <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card" style="width: 15rem;">
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $category)
                                <li class="list-group-item"><a class="text-secondary" href="{{ url("/categories/{$category->id}") }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9">
                    @foreach ($products as $product)
                        <div class="card bg-light" style="width: 50rem; height: 15rem;">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img height="238rem" class="card-img-top" src="/uploads/{{ $product->display_image }}" alt="Card image cap">
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body">
                                        <p class="card-text">Name: {{ $product->name }}</p>
                                        <p class="card-text">Brand: {{ $product->brand }}</p>
                                        <p class="card-text">Condition: {{ $product->condition }}</p>
                                        <p class="card-text">Price: {{ $product->proposed_price }}</p>
                                        <a href="{{ url("/advertisements/{$product->id}") }}" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    @endforeach
                </div>
            </div>
        
    </div>
</body>
@include('layouts.footer')
</html>