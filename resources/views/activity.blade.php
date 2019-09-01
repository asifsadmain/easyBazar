<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button {
        opacity: 1;
    }
</style>

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
            <div class="card mb-3" style="max-width: 50rem;">
                <br>
                <div class="row">
                    <div class="card bg-info" style="width: 18rem; height: 10rem; left: 10%;">
                        <div class="card-body">
                            <br><br>
                            <h1 class="text-white text-center">{{ count($ads) }}</h1>
                            <h3 class="text-center text-white">advertisements</h3>
                        </div>
                    </div>

                    <div class="card bg-success" style="width: 18rem; height: 10rem; left: 20%;">
                        <div class="card-body">
                            <br><br>
                            <h1 class="text-white text-center">{{ $totalSells }}</h1>
                            <h3 class="text-center text-white">sold</h3>
                        </div>
                    </div>
                </div>
                <br>
                <h3 class="text-center bg-secondary text-white">My Advertisements</h3>
                <table class="table table-striped">
                    <thead>
                        
                    </thead>
                    <tbody>
                        @foreach ($ads as $ad)
                        <tr>
                            {{-- <th scope="row">#</th> --}}
                            <td><img src="/uploads/{{ $ad->display_image }}" alt="image not supported" height="100px" width="100px"></td>
                            <td class="font-weight-bold"><a class="float-left" href="{{ url("/advertisements/{$ad->id}") }}"> {{ $ad->name }} </a></td>
                            <td>
                                <form action={{ URL::to("/activities/updateqty/{$ad->id}/{$ad->product_id}") }} method="post">
                                    @csrf
                                    <input name="qty" type="number" min="0" style="width:30px;" value="{{ $ad->quantity }}">
                                    <input type="submit" value="update qty.">
                                </form>
                            </td>
                            <td>
                                <a class="text-white btn btn-primary float-right" href="{{ url("/editAd/{$ad->id}") }}">Update</a>
                            </td>
                            <td>
                                <a class="text-white btn btn-danger" href="{{ url("/deleteAd/{$ad->id}") }}" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function myFuntion() {
        confirm("Press a button!");
    }
</script>



