@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <div class="card" style="width: 50rem;">
                <img src="/uploads/avatar.jpg" height="200px" width="200px" class="align-self-center" alt="...">
                <br>
                <div class="card-body">
                    <h3 class="card-text text-primary text-center">{{ $user->name }}</h3>
                    <br>
                    <p class="card-text text-center"> <strong>Email: </strong>{{ $user->email }}</p>
                    <p class="card-text text-center"> <strong>Address: </strong>{{ $user->address }}</p>
                    <p class="card-text text-center"> <strong>Mobile No: </strong>{{ $user->mobile_no }}</p>
                    <p class="card-text text-center"> <strong>Personal Bkash No: </strong>{{ $user->personal_bkash_no }}</p>
                    @if ($user->paypal_account_no)
                        <p class="card-text text-center"> <strong>Account No: </strong>{{ $user->paypal_account_no }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>