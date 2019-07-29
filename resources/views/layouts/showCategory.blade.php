<style>
    .flip-card {
        background-color: transparent;
        width: 150px;
        height: 150px;
        border: 1px solid #f1f1f1;
        perspective: 1000px; /* Remove this if you don't want the 3D effect */
    }
    
    /* This container is needed to position the front and back side */
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }
    
    /* Do an horizontal flip when you move the mouse over the flip box container */
    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }
    
    /* Position the front and back side */
    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
    }
    
    /* Style the front side (fallback if image is missing) */
    .flip-card-front {
        background-color: #bbb;
        color: black;
    }
    
    /* Style the back side */
    .flip-card-back {
        background-color: gray;
        color: white;
        transform: rotateY(180deg);
    }
    </style>
    
    <div class="container container-fluid">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-2">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img class="img-center" src="/uploads/{{ $category->image }}" alt="category" style="width:150px;height:150px;">
                            </div>
                            <div class="flip-card-back">
                                <br><br>
                                <a class="text-center text-white" href="{{ url("/categories/{$category->id}") }}">{{ $category->name }}</a>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="card" style="width: 9rem; height: 12rem">
                        <img height="100rem" width="90rem" src="/uploads/{{ $category->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a class="text-center text-secondary" href="{{ url("/categories/{$category->id}") }}">{{ $category->name }}</a>
                        </div>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </div>
    
    <script>
        function myFunction(category)
        {
            var myImg = document.getElementById("myImg");
            myImg.innerHTML = "hello world";
        }
    </script>
    