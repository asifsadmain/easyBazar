@extends('layouts.app')
<script src="js/addons/rating.js"></script>
@section('content')
<div class="container">
  <span id="rateMe2"  class="empty-stars"></span>
</div>

<script>
  // Rating Initialization
  $(document).ready(function() {
    $('#rateMe2').mdbRate();
  });
</script>
@endsection