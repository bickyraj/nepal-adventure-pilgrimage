<?php
  if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
  }

  if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
  }
?>
@extends('layouts.front_inner')
@section('content')

<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="">
    <div class="overlay absolute">
        <div class="container ">
            <h1>{{ $trip->name }}</h1>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking Form</li>
                    </ol>
                </nav>
            </div>
        </div>
</section>

<section class="py-5" x-data="{ noOfTravellers: 1, rate: {{ ($trip->offer_price != 0)? $trip->offer_price: $trip->cost }} }">
    <div class="container">
        <div class="grid lg:grid-cols-3 xl:grid-cols-4 gap-4 xl:gap-3">
            <div class="lg:col-span-2 xl:col-span-3">
                {{-- <form id="captcha-form" action="{{ route('front.trips.booking.store') }}" method="POST"> --}}
                <form id="captcha-form" action="{{ route('front.store_payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $trip->id }}">
                    <h2 class="fs-lg bold text-primary mb-2" style="font-size: 30px; padding: 20px 0px; font-weight: 800;">Personal details</h2>
                    <div class="grid lg:grid-cols-3 gap-4 mb-2">
                        <div class="form-group">
                            <label for="">Full name *</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Full name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Country *</label>
                            @include('front.elements.country')
                        </div>
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Contact no. *</label>
                            <input type="tel" name="contact_no" class="form-control" placeholder="Contact no." required>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-3 gap-2 mb-2">
                        <div class="form-group">
                            <label for="">Gender </label>
                            <select name="gender" id="" class="form-control">
                                <option value="" selected disabled>Gender</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                            </select>
                        </div>
                       </div>
                    <br>
                    <hr class="mb-2">

                    <h2 class="fs-lg bold text-primary mb-2">Trip details</h3>
                         <div class="grid lg:grid-cols-3 gap-2 mb-2">
                             <div class="form-group">
                                    <label for="">No. of travellers </label>
                                    <input type="number" name="no_of_travellers" class="form-control" min="1" x-model="noOfTravellers" placeholder="No. of travellers">
                                </div>
                            <div class="form-group">
                                <label for="">Preferred departure date</label>
                                <input type="date" name="preferred_departure_date" name="" id="" class="form-control" min="<?php echo date('Y-m-d');?>">
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-1 gap-2 mb-2">
                            <div class="form-group">
                                <label for="">Message </label>
                                <textarea name="emergency_contact" id="" cols="60" rows="6" class="form-control"
                                placeholder="Message"></textarea>
                            </div>
                        </div>
                        @include('front.elements.recaptcha')
                        <button id="make_a_payment_btn" type="submit" class="btn btn-theme" style="background: #ff4c02; color: #fff;">Submit</button>
                </form>
            </div>

           <aside>
                    <div class="p-4 rounded-lg bg-light">
                        <h2 class="text-2xl font-bold text-primary">Book {{ $trip->name }}</h2>
                        <div class="mt-4 card-body">
                            <p class="flex justify-between"><span>Duration:</span>{{ $trip->duration }} days</p>
                            <p class="flex justify-between"><span>No of Travellers:</span><span><span x-text="noOfTravellers"></span> people</span></p>
                            <p class="flex justify-between"><span>Rate:</span><span>USD <span x-text="rate.toLocaleString()"></span></span></p>
                            <hr>
                            <p class="flex justify-between"><span>Total amount:</span><span class="font-bold text-primary">USD <span x-text="(noOfTravellers * rate).toLocaleString()"></span></span></p>

                        </div>
                    </div>
                </aside>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
  $(function() {
    var session_success_message = '{{ $session_success_message ?? '' }}';
    var session_error_message = '{{ $session_error_message ?? '' }}';
    if (session_success_message) {
      toastr.success(session_success_message);
    }

    if (session_error_message) {
      toastr.danger(session_error_message);
    }

    $(document).on('click', '#make_a_payment_btn', function(ev) {
        ev.preventDefault();
        let btn = $(this);
        btn.prop('disabled', true);
        btn.html('submitting...');
        setTimeout(() => {
            $("#captcha-form").submit();
        }, 1000);
    });
  });
</script>
@endpush
