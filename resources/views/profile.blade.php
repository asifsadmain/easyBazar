@extends('layouts.app')

@section('content')

<div class="container">
    <div class="div row">
        <div class="div col-md-7">
        <div style="padding: 5%" class="card text-center">
            <h2 style="font: italic; font-family: fantasy;"> Your Posts : {{ count($adds) }} <h2>
        </div>
        
        <div class="container card">
            @foreach ($adds as $category)
                <p class="card-header font-weight-bold">{{ $category->name }} 
                    {{-- <a href="{{ url("/editAd/{$category->id}") }}">Update</a> --}}
                </p>
                <div class="card-body">
                    <p class="container">Brand : {{ $category->brand }}</p>
                    <p class=" container">Condition : {{ $category->condition }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-5 container">
        <div style="padding: 5%" class="card text-center">
            <h2 style="font: italic; font-family: fantasy;"> Profile : <h2>
        </div>
        <div class="card text-center">
        <img class="card-img-top" src="/uploads/avatar.jpg" alt="Card image cap">
        <div class="card-body">
                <table class="container table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>{{ $profile_full->name }}</th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th>Email</th>
                <th>{{ $profile_full->email }}</th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th>Address</th>
                <th>{{ $profile_full->address }}</th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th>Mobile No</th>
                <th>{{ $profile_full->mobile_no }}</th>
            </tr>
            </thead>
        </table>
        </div>           
    </div>
</div>

</div>
</div>
    


<br>
<br>
<br>

<div class="container" style="margin-top=20">
    @include('layouts.footer')
</div>    
@endsection