@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <div class="card" style="width: 50rem;">
                <img src="/uploads/avatar.jpg" height="200px" width="200px" class="align-self-center" alt="...">
                <br>
                <div class="card-body">
                    <h3 class="card-text text-primary text-center">{{ $dm->name }}</h3>
                    <br>
                    <p class="card-text text-center"> <strong>Email: </strong>{{ $dm->email }}</p>
                    <p class="card-text text-center"> <strong>Address: </strong>{{ $dm->address }}</p>
                    <p class="card-text text-center"> <strong>Mobile No: </strong>{{ $dm->mobile_no }}</p>
                </div>
            </div>
        </div>
    </div>
</div>