@extends('layouts.appdm')
    
@section('content')
<div class="row container">
    <div class="col-md-3"></div>
    <div class="col-md-9">
        <div class="card" style="width: 100%;">
            <ul class="list-group list-group-flush">
                @if ($transaction->product_received)
                    <li class="list-group-item">
                        <h4><i class="fas fa-2x fa-check-circle" style="color:green"></i>Product has been received from the seller</h4>
                    </li>
                @else
                    <li class="list-group-item">
                        <h4><i class="fas fa-2x fa-times-circle" style="color:red"></i>Product has been received from the seller
                            <a href="/receiveProduct" class="btn btn-success float-right">Mark as Received</a>
                        </h4>
                    </li>
                @endif
                @if ($transaction->seller_paid)
                    <li class="list-group-item">
                        <h4><i class="fas fa-2x fa-check-circle" style="color:green"></i>Seller has been paid</h4>
                    </li>
                @else
                    <li class="list-group-item">
                        <h4><i class="fas fa-2x fa-times-circle" style="color:red"></i>Seller has been paid
                            <a href="/paySeller" class="btn btn-success float-right">Mark as Paid</a>
                        </h4>
                    </li>
                @endif
                @if ($transaction->delivered_product)
                    <li class="list-group-item">
                        <h4><i class="fas fa-2x fa-check-circle" style="color:green"></i>Product has been deliverd to buyer</h4>
                    </li>
                @else
                    <li class="list-group-item">
                        <h4><i class="fas fa-2x fa-times-circle" style="color:red"></i>Product has been deliverd to buyer
                            <a href="/deliverProduct" class="btn btn-success float-right">Mark as Delivered</a>
                        </h4>
                    </li>
                @endif
                @if ($transaction->payment_received)
                    <li class="list-group-item">
                        <h4><i class="fas fa-2x fa-check-circle" style="color:green"></i>Buyer has paid to delivery man</h4>
                    </li>
                @else
                    <li class="list-group-item">
                        <h4><i class="fas fa-2x fa-times-circle" style="color:red"></i>Buyer has paid to delivery man
                            <a href="/receivePayment" class="btn btn-success float-right">Mark as Paid</a>
                        </h4>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection