@extends('layouts.app')
@section('content')
    <div>
        <h1 class="display-1 text-center text-secondary"> Welcome to EasyBazar</h1>
        <h3 class="text-center font-italic text-secondary">The most trustworthy online buy and sell platform for you</h3>
    </div>
    <br><br>
    @include('layouts.showCategory')
    <br><br><br>
    @include('layouts.footer')
@endsection