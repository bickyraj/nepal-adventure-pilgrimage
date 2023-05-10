@extends('layouts.front')
@section('content')



    <!-- Hero -->
    <section class="hero hero-alt relative">
       {{--<img src="{{ asset('assets/front/img/hero.jpg') }}" alt=""> --}}
       <img src="{{ $page->imageUrl }}">
        <div class="overlay absolute">
            <div class="container ">
                <h1>{{ $page->name ?? '' }}</h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page->name ?? '' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="about-page py-3">
        <div class="container">
            <div class="grid lg:grid-cols-3 xl:grid-cols-1 gap-1">
                <div class="lg:col-2 xl:col-3">
                    <div class="tour-details-section lim">
                        <p>
                            <?= $page->description ?? ''; ?>
                        </p>
                    </div>
                </div>
                <aside>
                    <!-- enquiry block -->
         {{-- @include('front.elements.enquiry')--}}
          <!-- end of enquiry block -->
                </aside>
            </div>
        </div>

    </section>
   


<!--<section class="hero-second">-->
<!--  <div class="slide" style="background-image: url({{ $page->imageUrl ?? '' }})">-->
<!--  </div>-->
<!--  <div class="hero-bottom">-->
<!--    <div class="container">-->
<!--      <h1>{{ $page->name ?? '' }}</h1>-->
<!--      <nav aria-label="breadcrumb">-->
<!--        <ol class="breadcrumb">-->
<!--          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>-->
<!--          <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>-->
<!--        </ol>-->
<!--      </nav>-->
<!--    </div>-->
<!--</section>-->

<!--<section class="tour-details">-->
<!--  <div class="container mt-2">-->
<!--    <div class="row">-->
<!--      <div class="col-md-8 col-lg-9">-->
<!--        <div class="tour-details-section">-->
<!--        	<div>-->
<!--        		<?= $page->description ?? ''; ?>-->
<!--        	</div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-md-4 col-lg-3">-->
<!--        <aside>-->
          <!-- enquiry block -->
<!--          @include('front.elements.enquiry')-->
          <!-- end of enquiry block -->
<!--        </aside>-->
<!--      </div>-->
<!--    </div>-->
<!--</section>-->
@endsection
