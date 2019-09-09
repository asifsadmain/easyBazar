@extends('layouts.app')

<style>
    /* The grid: Four equal columns that floats next to each other */
.column {
    float: left;
    width: 20%;
    padding: 10px;
}

/* Style the images inside the grid */
.column img {
    opacity: 0.8; 
    cursor: pointer; 
}

.column img:hover {
    opacity: 1;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* The expanding image container (positioning is needed to position the close button and the text) */
.containerNew {
    position: relative;
    display: none;
}

/* Expanding image text */
#imgtext {
    position: absolute;
    bottom: 15px;
    left: 15px;
    color: white;
    font-size: 20px;
}

/* Closable button inside the image */
.closebtn {
    position: absolute;
    top: 10px;
    right: 15px;
    color: white;
    font-size: 35px;
    cursor: pointer;
}
</style>

@section('content')

@foreach ($advertisements as $advertisement)
<div class="container container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="column">
                    <img src="/uploads/{{ $advertisement->display_image }}" width="50" height="50" alt="Nature" onload="myFunction(this);" onclick="myFunction(this);">
                </div>
                <div class="column">
                    <img src="/uploads/{{ $advertisement->img1 }}" width="50" height="50" alt="Snow" onclick="myFunction(this);">
                </div>
                <div class="column">
                    <img src="/uploads/{{ $advertisement->img2 }}" width="50" height="50" alt="Mountains" onclick="myFunction(this);">
                </div>
                <div class="column">
                    <img src="/uploads/{{ $advertisement->img3 }}" width="50" height="50" alt="Lights" onclick="myFunction(this);">
                </div>
                <div class="column">
                    <img src="/uploads/{{ $advertisement->img4 }}" width="50" height="50" alt="Lights" onclick="myFunction(this);">
                </div>
            </div>

            <div class="containerNew">
                <!-- Close the image -->
                <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
                
                <!-- Expanded image -->
                <img id="expandedImg" height="450" width="450">
                
                <!-- Image text -->
                <div id="imgtext"></div>
            </div>
        </div>
        <div class="bg-light col-sm-6">
            <h1 class="text-primary text-center">{{ $advertisement->product_name }}</h1>
            <h3 class="text-danger text-center">BDT: {{ $advertisement->proposed_price }}</h3>
            <p class="text-primary text-center">{{ $advertisement->address }}</p>
            <h5 class="card-text">Brand:</h5>
            <p class="card-text">{{ $advertisement->brand }}</p>
            <h5 class="card-text">Condition:</h5>
            <p class="card-text">{{ $advertisement->condition }}</p>
            @if ($advertisement->buying_year)
                <h5 class="card-text">Buying Year:</h5>
                <p class="card-text">{{ $advertisement->buying_year }}</p>
            @endif
            <h5 class="card-text">Specification:</h5>
            <p class="card-text">{{ $advertisement->specification }}</p>
            @if ($advertisement->color)
                <h5 class="card-text">Color:</h5>
                <p class="card-text">{{ $advertisement->color }}</p>
            @endif
            @if ($advertisement->weight)
                <h5 class="card-text">Weight:</h5>
                <p class="card-text">{{ $advertisement->weight }} kg(s)</p>
            @endif
            @if ($advertisement->size)
                <h5 class="card-text">Size:</h5>
                <p class="card-text">{{ $advertisement->size }} metre(s)</p>
            @endif
            @if ($advertisement->guarantee)
                <h5 class="card-text">Guarantee:</h5>
                <p class="card-text">{{ $advertisement->guarantee }} month(s)</p>
            @endif
            @if ($advertisement->warranty)
                <h5 class="card-text">Warranty:</h5>
                <p class="card-text">{{ $advertisement->warranty }} month(s)</p>
            @endif
            @if (Auth::user())
                @if ($ifRequested->isEmpty())
                    <a id="request" href="/requestSeller/{{ $advertisement->user_id }}/{{ $advertisement->product_id }}" class="btn btn-success">Request seller to buy this product</a>
                @else
                    <a id="request" href="" class="btn btn-secondary">You've already requested the seller</a>
                @endif
            @endif
            @if (Auth::user())
                <form method="POST" action="{{ URL::to("/showAd/sendMessage/{$advertisement->user_id}") }}">
                    @csrf
                    <br>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <textarea id="text" rows="5" class="form-control @error('text') is-invalid @enderror" name="text" value="{{ old('text') }}" autocomplete="text" placeholder="Send a message to contact with the seller..." autofocus></textarea>

                            @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endforeach


<script>
function myFunction(imgs) {
    // Get the expanded image
    var expandImg = document.getElementById("expandedImg");
    // Get the image text
    var imgText = document.getElementById("imgtext");
    // Use the same src in the expanded image as the image being clicked on from the grid
    expandImg.src = imgs.src;
    // Use the value of the alt attribute of the clickable image as text inside the expanded image
    imgText.innerHTML = imgs.alt;
    // Show the container element (hidden with CSS)
    expandImg.parentElement.style.display = "block";
}
</script>

@endsection