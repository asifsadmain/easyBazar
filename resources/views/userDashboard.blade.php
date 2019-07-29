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
                <img src="/uploads/avatar.jpg" height="200px" width="200px" class="align-self-center" alt="...">
                <div class="card-body">
                    <h3 class="card-text text-primary text-center">{{ $profile_full->name }}</h3>
                    <br>
                    <p class="card-text text-center"> Email: {{ $profile_full->email }}</p>
                    <p class="card-text text-center"> Address: {{ $profile_full->address }}</p>
                    <p class="card-text text-center"> Date of Birth: {{ $profile_full->date_of_birth }}</p>
                    <p class="card-text text-center"> Mobile No: {{ $profile_full->mobile_no }}</p>
                    <p class="card-text text-center"> Personal Bkash No: {{ $profile_full->personal_bkash_no }}</p>
                    @if ($profile_full->paypal_account_no)
                        <p class="card-text text-center"> Paypal Account No: {{ $profile_full->paypal_account_no }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>