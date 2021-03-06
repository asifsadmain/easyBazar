<style>
    #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
    }
</style>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div id="header_card" class="card-header">{{ __('Register as Deliveryman') }}</div>
                <div style="padding : 6%; font-size:125%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" class="container">                
                <div class="bg_all card-body">
                    <form method="POST" action="{{ URL::to('/dm/register/submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="label_font col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="label_font col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="label_font col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="label_font col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth" class="label_font col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus>

                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="label_font col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile_no" class="label_font col-md-4 col-form-label text-md-right">{{ __('Mobile No') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus>

                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="availability" class="label_font col-md-4 col-form-label text-md-right">{{ __('Availability') }}</label>

                            <div class="col-md-6">
                                <select  class="form-control" name="availability">
                                    <option value='TRUE'>Available</option>
                                    <option value='FALSE'>Unavailable</option>
                                </select>  
                                @error('availability')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="preffered_loc1" class="label_font col-md-4 col-form-label text-md-right">{{ __('Preferred Location 1 (optional)') }}</label>

                            <div class="col-md-6">
                                <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control" name="preffered_loc1" value="{{ old('preffered_loc1') }}" autocomplete="preffered_loc1" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="preffered_loc2" class="label_font col-md-4 col-form-label text-md-right">{{ __('Preferred Location 2 (optional)') }}</label>

                            <div class="col-md-6">
                                <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control" name="preffered_loc2" value="{{ old('preffered_loc2') }}" autocomplete="preffered_loc2" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="preffered_loc3" class="label_font col-md-4 col-form-label text-md-right">{{ __('Preferred Location 3 (optional)') }}</label>

                            <div class="col-md-6">
                                <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control" name="preffered_loc3" value="{{ old('preffered_loc3') }}" autocomplete="preffered_loc3" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="preffered_loc4" class="label_font col-md-4 col-form-label text-md-right">{{ __('Preferred Location 4 (optional)') }}</label>

                            <div class="col-md-6">
                                <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control" name="preffered_loc4" value="{{ old('preffered_loc4') }}" autocomplete="preffered_loc4" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script
    // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    
    var placeSearch, autocomplete;
    
    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), {types: ['geocode']});
    
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);
        
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }
    
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle(
                {center: geolocation, radius: position.coords.accuracy});
            autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCICVFZg9PawAeVO5oH_BRdE7IEu93eG8E&libraries=places&callback=initAutocomplete"
async defer></script>
@endsection
