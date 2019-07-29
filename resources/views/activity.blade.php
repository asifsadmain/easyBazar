@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-sm-3" style="top: 20%; height: 100%;">
            <div class="card" style="width: 15rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a class="text-secondary font-weight-bold" href="{{ URL::to('/userDashboard') }}">My Profile</a></li>
                    <li class="list-group-item"><a class="text-secondary font-weight-bold" href="{{ URL::to('/userDashboard/activities') }}">My Activities</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card" style="width: 50rem;">
                <br>
                <div class="row">
                    <div class="card bg-secondary" style="width: 18rem; height: 10rem; left: 10%;">
                        <div class="card-body">
                            <br><br>
                            <h1 class="text-white text-center">{{ count($ads) }}</h1>
                            <h3 class="text-center text-white">advertisements</h3>
                        </div>
                    </div>

                    <div class="card bg-secondary" style="width: 18rem; height: 10rem; left: 20%;">
                        <div class="card-body">
                            <br><br>
                            <h1 class="text-white text-center">0</h1>
                            <h3 class="text-center text-white">sold</h3>
                        </div>
                    </div>
                </div>
                <br>
                <h3 class="text-center bg-dark text-white">My Advertisements</h3>
                <div class="container card">
                    @foreach ($ads as $ad)
                        <div class="row bg-primary">
                            <div class="col-sm-8">
                                    <p class="card-header font-weight-bold text-white">{{ $ad->name }}</p>
                            </div>
                            <div class="col-sm-2">
                                    <a class="text-white btn btn-secondary" href="{{ url("/editAd/{$ad->id}") }}">Update</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="text-white btn btn-secondary" href="#">Delete</a>
                            </div>
                        </div>
                        {{-- <p class="card-header font-weight-bold bg-primary text-white">{{ $ad->name }} 
                            <a class="text-white btn btn-primary" href="{{ url("/editAd/{$ad->id}") }}">Update</a>
                        </p> --}}
                        <div class="card-body">
                            <p class="container">Brand : {{ $ad->brand }}</p>
                            <p class=" container">Condition : {{ $ad->condition }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>