<style>
    body, html {
        height: 100%;
    }
    
    * {
        box-sizing: border-box;
    }
    
    .bg-image {
        /* The image used */
        background-image: url("/uploads/ecommerce.jpg");
    
        /* Add the blur effect */
        filter: blur(8px);
        -webkit-filter: blur(8px);
    
        /* Full height */
        height: 80%; 
    
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    /* Position text in the middle of the page/image */
    .bg-text {
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
        color: white;
        font-weight: bold;
        border: 3px solid #f1f1f1;
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 80%;
        padding: 20px;
        text-align: center;
    }
    .bg-category {
        color: black;
        font-weight: bold;
        position: absolute;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 80%;
        padding: 20px;
        text-align: center;
    }
    </style>
    
    @extends('layouts.app')
    
    @section('content')
    <div class="bg-image"></div>
    
        <div class="bg-text">
            <h1>Welcome to EasyBazar</h1>
            <p>The most trustworthy online buy and sell platform for you</p>
            <br>
        </div>
        <div class="bg-category">
            <h3>Select Category</h3>
            @include('layouts.showCategory')
        </div>
    @endsection
    