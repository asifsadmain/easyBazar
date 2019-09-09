@extends('layouts.app')

@section('content')
    <div class="card" style="width: 30rem; left:30%;">
        <div class="card-body text-center">
            <h5 class="card-title text-center text-white bg-primary">Order details</h5>
            <p class="card-text"><strong>Product Name: </strong>{{ $product->name }}</p>
            <p class="card-text"><strong>Seller's Name: </strong>{{ auth()->user()->name }}</p>
            <p class="card-text"><strong>Seller's Address: </strong>{{ auth()->user()->address }}</p>
            <p class="card-text"><strong>Buyer's Name: </strong>{{ $buyer->name }}</p>
            <p class="card-text"><strong>Buyer's Address: </strong>{{ $buyer->address }}</p>
            @foreach ($ad as $ada)
            <p class="card-text"><strong>Price: </strong>BDT{{ $ada->proposed_price }}</p>
            @endforeach
            <a href="javascript:history.back()" class="card-link">Go back to homepage</a>
        </div>
    </div>
@endsection
        