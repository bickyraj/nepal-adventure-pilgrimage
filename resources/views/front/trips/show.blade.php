<?php
$mapImageUrl = $trip->mapImageUrl;
$page_trip_id = $trip->id;
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
@section('meta_og_title'){!! $trip->trip_seo->meta_title??'' !!}@stop
@section('meta_description'){!! $trip->trip_seo->meta_description??'' !!}@stop
@section('meta_keywords'){!! $trip->trip_seo->meta_keywords??'' !!}@stop
@section('meta_og_url'){!! $trip->trip_seo->canonical_url??'' !!}@stop
@section('meta_og_description'){!! $trip->trip_seo->meta_description??'' !!}@stop
@section('meta_og_image'){!! $trip->trip_seo->ogImageUrl??'' !!}@stop
@push('styles')
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
 <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "@yield('meta_og_title')",
      "image": [
        "@yield('meta_og_url')" ],
      "description": "@yield('meta_description')",
      "sku": "Nepal Adventure Pilgrimage",
      "mpn": "Nepal Adventure Pilgrimage",
      "brand": {
        "@type": "Brand",
        "name": "Nepal Adventure Pilgrimage"
      },
      "review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "4",
          "bestRating": "5"
        },
        "author": {
          "@type": "Person",
          "name": "Nepal Adventure Pilgrimage"
        }
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "89"
      },
      "offers": {
        "@type": "Offer",
        "url": "{{ route('front.trips.show', ['slug' => $trip->slug]) }}",
        "priceCurrency": "USD",
        "price": "{{ ($trip->offer_price) }}",
        "priceValidUntil": "2030-11-20",
        "itemCondition": "https://schema.org/UsedCondition",
        "availability": "https://schema.org/InStock"
      }
    }
    </script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
<style>
    .embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
</style>
<style type="text/css">
    .blocker {
        z-index: 10000 !important;
    }

  .modal {
    z-index: 99999 !important;
  }
  .map-image-modal {
    cursor: zoom-in;
    object-fit: cover;
    /*width: 200px;*/
  }

  .trip-faq-description ul li {
      list-style-type: inherit !important;
  }

  .modal-body {
      /* 100% = dialog height, 120px = header + footer */
      /*height: 70vh;*/
      /*overflow-y: scroll;*/
  }
</style>
@endpush
@section('content')

<!-- Hero -->
<section class="hero relative">
    <div id="hero-slider" class="hero-slider">
        @if(iterator_count($trip->trip_galleries))
        @foreach($trip->trip_galleries as $gallery)
           <img class="lazy" src="{{ $gallery->imageUrl }}" class="block" alt="">
        @endforeach
        @endif
    </div>

    <div class="overlay absolute w-full">
        <div class="container flex justify-between items-end flex-wrap">
            <div>
                <div class="hero-slider-controls none md:block">
                    <div class="flex">
                        <button>
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowleft" />
                            </svg>
                        </button>
                        <button>
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright" />
                            </svg>
                        </button>
                    </div>
                </div>

                <h1 class="mb-2 font-display text-white text-4xl lg:text-4xl lg:text-5xl uppercase">
                    <span>{{ $trip->name }} -  {{ $trip->duration }} days</span>
                </h1>

                <div class="breadcrumb-wrapper none md:block">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('front.trips.listing') }}">Trips</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $trip->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="bg-gray">
    <!-- Sticky Nav -->
    <div class="tdb bg-primary text-black sticky-top" style="top:5rem;z-index:98">
        <div class="container flex justify-center items-center">
            <nav class="tour-details-tabs flex justify-center items-center" id="secondnav">
                <ul class="nav flex flex-wrap py-1">
                    <li class="mr-2">
                        <a href="#overview" class="flex items-center p-2 hover:bg-white hover:text-primary">
                            <svg class="w-6 h-6 md:mr-2">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viewgrid" />
                            </svg>
                            <span class="none md:block">Overview</span>
                        </a>
                    </li>
                    @if (!$trip->trip_itineraries->isEmpty())
                        <li class="mr-2">
                            <a href="#itinerary" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                <svg class="w-6 h-6 md:mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#clock" />
                                </svg>
                                <span class="none md:block">Itinerary</span></a>
                        </li>
                    @endif

                    @if ($trip->trip_include_exclude)
                        <li class="mr-2">
                            <a href="#inclusions" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                <svg class="w-6 h-6 md:mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#archive" />
                                </svg>
                                <span class="none md:block">Inclusions</span>
                            </a>
                        </li>
                    @endif

                    @if (!$trip->trip_departures->isEmpty())
                        <li class="mr-2">
                            <a href="#date-price" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                <svg class="w-6 h-6 md:mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#calendar" />
                                </svg>
                                <span class="none md:block">Date & Price</span></a>
                        </li>
                    @endif

                    <li class="mr-2">
                        <a href="#reviews" class="flex items-center p-2 hover:bg-white hover:text-primary">
                            <svg class="w-6 h-6 md:mr-2">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#chat" />
                            </svg>
                            <span class="none md:block">Review</span></a>
                    </li>

                    @if (!$trip->trip_faqs->isEmpty())
                        <li class="mr-2">
                            <a href="#faqs" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                <svg class="w-6 h-6 md:mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#questionmarkcircle" />
                                </svg>
                                <span class="none md:block">FAQs</span></a>
                        </li>
                    @endif
                    <li class="mr-2">
                            <a href="#packing-list" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                <svg class="w-6 h-6 md:mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#questionmarkcircle" />
                                </svg>
                                <span class="none md:block">Packing List</span></a>
                        </li>

                </ul>
            </nav>
        </div>
        <div id="tourDetailsBarIO"></div>
    </div><!-- Sticky Nav -->

    <div class="container mt-2 pb-20">

        <div class="grid lg:grid-cols-3 xl:grid-cols-4 gap-2 lg:gap-10">

            <div class="tour-details lg:col-span-2 xl:col-span-3 relative">

                <div class="lg:none">
                    @include('front.elements.price_card')
                </div>

                <div id="overview" class="tds pt-10 bg-white px-4 lg:px-10 pb-4 mb-4">
                    <div>

                        <div class="mb-6 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#calendarduration" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Duration
                                    </div>
                                    <div>
                                        {{ $trip->duration }} days
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#maxelevation" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Max. Elevation
                                    </div>
                                    <div>
                                        {{ $trip->max_altitude }}m
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#groupsize" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Group size
                                    </div>
                                    <div>
                                        {{ $trip->group_size }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#level" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Level
                                    </div>
                                    <div>
                                        {{ $trip->difficulty_grade_value }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#transportation" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Transportation
                                    </div>
                                    <div>
                                        <?= $trip->trip_info->transportation??'' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#bestseason" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Best Season
                                    </div>
                                    <div>
                                        {{ $trip->trip_info->best_season??'' }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#accomodation" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Accomodation
                                    </div>
                                    <div>
                                       <?= $trip->trip_info->accomodation??'' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#meals" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Meals
                                    </div>
                                    <div>
                                        <?= $trip->trip_info->meals??'' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#startsat" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Starts at
                                    </div>
                                    <div>
                                        {{ $trip->starting_point }}
                                    </div>
                                </div>
                            </div>

                            <div class="table-item flex aic">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#endsat" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Ends at
                                    </div>
                                    <div>
                                        {{ $trip->ending_point }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex aic lg:col-span-2">
                                <div class="mr-4">
                                    <svg class="w-10 h-10 text-primary">
                                        <use xlink:href="{{asset('assets/front/img/sprite.svg')}}#triproute" />
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-sm font-bold text-primary">
                                        Trip Route
                                    </div>
                                    <div>
                                        {{ $trip->trip_info->trip_route??'' }}
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="px-3">

                            <h3 class="mb-2 font-display text-2xl text-primary">Highlights</h3>
                            <ul class="highlights mb-4">
                                {!! ($trip->trip_info)?$trip->trip_info->highlights:'' !!}
                            </ul>

                            <p id="overview-text" style="margin-bottom: 15px;" class=""><p>
                                {!! ($trip->trip_info)?$trip->trip_info->overview:'' !!}</p>
                            </p>
                            {{-- <p class="text-center">
                                <button id="toggle-overview" class="btn btn-gray" data-bs-toggle="collapse" data-bs-target="#overview-text">Show
                                    More</button>
                            </p> --}}

                            <div class="bg-light mb-3 p-4">
                                <h3 class="mb-2 font-display text-xl text-primary"> Important Note</h3>
                                <p class="mb-0 text-sm">
                                    {!! ($trip->trip_info)?$trip->trip_info->important_note:'' !!}
                                </p>
                            </div>
                        </div>
                    </div>


                </div>

                <!--<div class='mb-4 embed-container'><iframe src='https://www.youtube.com/embed//dFLxa0VwY-E' frameborder='0' allowfullscreen></iframe></div>-->

                <div id="itinerary" class="tds pt-10 bg-white px-4 lg:px-10 pb-4 mb-4" x-data="{
                    day1Open:true,
                    @for ($i = 1; $i < $trip->trip_itineraries->count() ; $i++)
                        day{{ $i + 1 }}Open:false,
                    @endfor
                    }">
                        <div class="flex justify-between items-end flex-wrap mb-4">
                            <h2 class="text-4xl lg:text-5xl font-display text-primary uppercase">Trip Itinerary</h2>
                            <div>
                                <button class="mb-2 btn btn-sm btn-primary expand-all" @click="
                                @for ($i = 0; $i < $trip->trip_itineraries->count(); $i++)
                                    day{{ $i + 1 }}Open =
                                @endfor
                                true">Expand All</button>
                                <button class="mb-2 btn btn-sm btn-primary collapse-all" @click="
                                @for ($i = 0; $i < $trip->trip_itineraries->count(); $i++)
                                    day{{ $i + 1 }}Open =
                                @endfor
                                false">Collapse All</button>
                            </div>
                        </div>
                        <div class="itinerary mb-4">
                            @foreach ($trip->trip_itineraries as $i => $itinerary)
                                <div class="mb-2 border-light">
                                    <button class="flex items-center w-full p-2 text-primary text-left" :aria-expanded="day{{ $i + 1 }}Open" aria-controls="day{{ $i+1 }}" @click="day{{ $i+1 }}Open=!day{{ $i+1 }}Open">
                                        <div class="flex items-center mr-4">
                                            <div class="mr-2 text-sm">Day</div>
                                            <div class="font-display text-primary text-2xl">
                                                {{ $itinerary->day }}
                                            </div>
                                        </div>
                                        <div class="flex justify-between flex-grow-1">
                                            <h3 class="font-display text-xl">{{ $itinerary->name }}</h3>
                                            <svg class="w-6 h-6 flex-shrink-0" x-show="!day{{ $i + 1 }}Open">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#plus" />
                                            </svg>
                                            <svg class="w-6 h-6 flex-shrink-0" x-show="day{{ $i + 1 }}Open">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#minus" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div id="day{{ $i+1 }}" class="border-top-light p-4" x-cloak x-show.transition="day{{ $i+1 }}Open">
                                        <!--<div class="grid xl:grid-cols-3 gap-4">-->
                                            {{-- <img src="{{ asset('assets/front/img/hero.jpg') }}" alt=""> --}}
                                            <div class="xl:col-span-2">
                                                <p>
                                                    {!! $itinerary->description !!}
                                                </p>
                                            </div>
                                        <!--</div>-->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="lg:flex justify-between items-center bg-light p-4">
                            <div>
                                Not satisfied with this itinerary? <b class="text-primary">Make your own</b>.
                            </div>
                            <a href="{{ route('front.trips.customize', $trip->slug) }}" class="btn btn-sm btn-primary">Customize</a>
                        </div>
                </div>

                <div id="inclusions" class="tds pt-10 bg-white px-4 lg:px-10 pb-4 mb-4">
                    <div class="bg-white p-3">
                        @if ($trip->trip_include_exclude)
                            <div class="grid lg:grid-cols-2 gap-1">
                                <div>
                                    <h2 class="text-3xl lg:text-4xl font-display text-primary uppercase">Includes</h2>
                                    <ul class="includes">
                                        <?= $trip->trip_include_exclude->include; ?>
                                    </ul>
                                </div>

                                <div>
                                    <h2 class="text-3xl lg:text-4xl font-display text-primary uppercase">Doesn't Include</h2>
                                    <ul class="excludes">
                                        <?= $trip->trip_include_exclude->exclude; ?>
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="complimentary p-2">
                            <h2 class="text-3xl lg:text-4xl font-display text-primary uppercase">Complimentary</h2>
                            <ul>
                                <?= $trip->trip_include_exclude->complimentary ??''; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                @if (!$trip->trip_departures->isEmpty())
                  <div id="date-price" class="">
                    <div class="bg-white p-4">
                         <h2 class="text-4xl lg:text-5xl font-display text-primary uppercase">Upcoming Departure Dates
                        </h2>
                        <div class="table-wrapper-scroll">
                            <table class="table mb-2">
                                <thead>
                                    <th class="upper text-left">Date</th>
                                    <th class="upper text-left">Price</th>
                                    <th class="upper text-left">Seats Left</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach($trip->trip_departures as $departure)
                                        <tr>
                                            <td>
                                                <div class="flex aic">
                                                    <svg class="icon mr-1 text-primary">
                                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}" />
                                                    </svg>
                                                    {{ formatDate($departure->from_date) }} — {{ formatDate($departure->to_date) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex aic">
                                                    <svg class="icon mr-1 text-primary">
                                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#tag') }}" />
                                                    </svg>
                                                    <div>
                                                        <small class="text-gray"><s>USD {{ number_format($trip->cost) }}</s></small><br>
                                                        <span class="text-green">USD <b>{{ number_format($departure->price) }}</b></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex aic">
                                                    <svg class="icon mr-1 text-primary">
                                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#users') }}" />
                                                    </svg>
                                                    {{ $departure->seats }}
                                                </div>
                                            </td>
                                            <td><a href="{{ route('front.trips.departure-booking', ['slug' => $trip->slug, 'id' => $departure->id]) }}" class="btn btn-sm btn-accent">Join Group</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- <p class="text-center"><button id="more-dates" class="btn btn-sm btn-gray">See more dates</button></p> -->
                        </div>
                    </div>
                </div>
                @endif

                 @if (iterator_count($trip->trip_reviews))
                        <div id="reviews" class="px-4 pt-10 pb-4 mb-4 bg-white tds lg:px-10">
                            <div class="items-center justify-between mb-4 lg:flex">
                                <h2 class="text-4xl uppercase lg:text-5xl font-display text-primary">Reviews
                                </h2>

                                <div>
                                    <a href="{{ route('front.reviews.create') }}" class="mr-1 btn btn-primary btn-sm" data-toggle="modal" data-target="#review-modal">
                                        Write a review</a>
                                </div>
                            </div>
                            <div class="grid gap-2 lg:grid-cols-1 lg:gap-3">

                                @foreach ($trip->trip_reviews()->where('status', 1)->get() as $review)
                                    <div class="p-4 review" style="border: 2px solid #d9d1d1;">
                                        <div class="review__content">
                                            <h2 class="mb-2 text-2xl font-display text-primary">{{ $review->title }}</h2>
                                            <p>{{ $review->review }}</p>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                <img src="{{ $review->thumbImageUrl }}" alt="">
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ $review->review_name }}</div>
                                                <div class="text-sm text-gray">{{ $review->review_country }}</div>
                                                <div class="flex items-center mr-4 text-accent">
                                            <svg class="w-4 h-4">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" /></svg>
                                            <svg class="w-4 h-4">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" /></svg>
                                            <svg class="w-4 h-4">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" /></svg>
                                            <svg class="w-4 h-4">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" /></svg>
                                            <svg class="w-4 h-4">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" /></svg>
            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <a href="{{ route('front.reviews.index') }}" class="theme">See more reviews
                                <svg>
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright" />
                                </svg>
                            </a>
                        </div>
                    @endif

                {{-- <div class="mb-4">
                    <iframe src="https://www.google.com/maps/d/embed?mid=1o2LaX1o68hVBiycWHWDrK_F18H1epiGB" width="100%" height="480" class="border-none"></iframe>
                </div> --}}

                @if(!$trip->trip_faqs->isEmpty())
                    <div id="faqs" class="tds pt-10 bg-white px-4 lg:px-10 pb-4 mb-4">
                        <h2 class="mb-4 text-4xl lg:text-5xl font-display text-primary uppercase">Frequently Asked Questions</h2>

                        <div class="mb-4" x-data="{active: 'none'}">
                            @foreach($trip->trip_faqs as $i => $faq)
                                <div class="mb-1 border-light">
                                    <button class="flex justify-between items-center w-full p-2 text-left" @click="active = (active === {{ $i }} ? 'none' : {{ $i }})">
                                        <h3 class="font-display text-xl text-primary">{{ $faq->title }}</h3>

                                        <svg class="w-6 h-6 flex-shrink-0 text-primary" x-show="active!=={{ $i }}">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#plus" />
                                        </svg>
                                        <svg class="w-6 h-6 flex-shrink-0 text-primary" x-show="active==={{ $i }}">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#minus" />
                                        </svg>
                                    </button>
                                    <div class="p-4" x-cloak x-show.transition="active==={{ $i }}">
                                        <p class="mb-0">
                                            {!! $faq->description !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="#" class="mb-2 theme">Read more FAQs
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright" />
                            </svg>
                        </a>
                    </div>
                @endif

                <div id="packing-list" class="tds pt-10 bg-white px-4 lg:px-10 pb-4 mb-4">
                    <h2 class="mb-4 text-4xl lg:text-5xl font-display text-primary uppercase">Packing List</h2>
                               <?= (($trip->trip_seo)?$trip->trip_seo->about_leader:''); ?>
                            </div>


                <div class="flex justify-between flex-wrap mb-4">
                    <div class="flex mb-2">
                        <a href="{{ route('front.trips.booking', $trip->slug) }}" class="btn btn-accent mr-2">Book Now</a>
                        <a href="{{ route('front.trips.customize', $trip->slug) }}" class="btn btn-primary">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#adjustments" />
                            </svg>
                            Customize
                        </a>
                    </div>
                    <div class="flex">
                        <a href="{{ route('front.trips.print', ['slug' => $trip->slug]) }}" class="flex items-center mr-2 p-1 text-accent" title="Print tour details">
                            <svg class="w-6 h-6 flex-shrink-0 mr-2">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#printer" />
                            </svg>
                            <span class="font-display uppercase">Print Tour Details</span>
                        </a>
                       @if($trip->pdfLink)
                <a href="{{ $trip->pdfLink }}" download target="_blank" class="print my-2"> <i class="fas fa-map"></i>
                    Download brochure</a>
                @endif
                    </div>
                </div>

                <div>
                    <h2 class="mb-2 lg:text-xl font-display text-primary uppercase">Share this tour</h2>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.trips.show', ['slug' => $trip->slug]) }}" class="text-primary hover:text-accent mr-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebook" />
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ route('front.trips.show', ['slug' => $trip->slug]) }}&text=" class="text-primary hover:text-accent mr-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#twitter" />
                        </svg>
                    </a>
                    <a href="{{ Setting::get('instagram') }}" class="text-primary hover:text-accent">
                        <svg class="w-6 h-6">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#instagram" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- aside --}}
            <aside class="pt-10">

                @include('front.elements.price_card'){{--
                <a href="{{ route('front.trips.booking', $trip->slug) }}" class="mb-8 btn btn-accent w-full">Ask for agency price</a>--}}



                @include('front.elements.enquiry')

                <!-- Route Map -->
                @if($trip->map_file_name)
                 <div class="mb-8">
                    <div class="card-header">
                        <h2 class="mb-2 font-display text-2xl text-primary uppercase">Route Map</h2>
                    </div>
                    <div class="card-body p-0">
                        <a href="#ex1" rel="modal:open">
                            <img class="img-fluid" src="{{ $trip->mapImageUrl }}" alt="{{ $trip->name }}">
                        </a>
                    </div>
                </div>
                @endif

                <div class="mb-8">
                    <div id="TA_selfserveprop436" class="TA_selfserveprop"><ul id="QilPdfnoM" class="TA_links Xdo3pBNRdif"><li id="hi9l2s7QoR7N" class="55xaWa"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g293890-d11964139-Reviews-Nepal_Adventure_Pilgrimage_Treks_and_Expedition_Pvt_Ltd-Kathmandu_Kathmandu_Vall.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-11900-2.svg" alt="TripAdvisor"/></a></li></ul></div><script async src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=436&amp;locationId=11964139&amp;lang=en_US&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
                </div>


                <div class="experts-card bg-primary px-2 py-10 text-black">
                    <div class="grid grid-cols-3">
                        <div class="col-span-2">
                            <p class="mb-0">Still confused?</p>
                            <h3 class="mb-2">Talk to our experts</h3>
                        </div>
                        <div>
                            <svg class="w-20 h-20">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#customersupport" />
                            </svg>
                        </div>
                    </div>
                    <div class="experts-phone flex mb-1">
                        <a href="{{ Setting::get('mobile1') }}" class="flex aic">
                            <svg class="w-6 h-6 mr-1">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                            </svg>
                            {{ Setting::get('mobile1') }}
                        </a>
                    </div>
                    <div class="experts-phone flex mb-1">
                        <a href="https://api.whatsapp.com/send?phone=9779851267334" class="flex aic">
                            <svg class="w-6 h-6 mr-1">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                            </svg>
                            +66818464735 (Thailand)
                        </a>
                    </div>
                    <div class="experts-phone flex mb-1">
                        <a href="https://api.whatsapp.com/send?phone=9779851267334" class="flex aic">
                            <svg class="w-6 h-6 mr-1">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                            </svg>
                            +33 670794972 (France)
                        </a>
                    </div>
                    <div class="experts-phone flex mb-3">
                        <a href="mailto:{{ Setting::get('email') }}" class="flex aic">
                            <svg class="w-6 h-6 mr-1">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                            </svg>
                            {{ Setting::get('email') }}
                        </a>
                    </div>
                </div>

                <div class="mb-8 p-2 bg-light">
                    <a href="{{ Setting::get('facebook') }}" class="text-primary hover:text-accent mr-1">
                        <svg class="w-6 h-6">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebookmessenger" />
                        </svg>
                    </a>
                    <a href="{{ Setting::get('viber') }}" class="text-primary hover:text-accent mr-1">
                        <svg class="w-6 h-6">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                        </svg>
                    </a>
                    <a href="{{ Setting::get('whatsapp') }}" class="text-primary hover:text-accent mr-1">
                        <svg class="w-6 h-6">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                        </svg>
                    </a>
                    <a href="{{ Setting::get('skype') }}" class="text-primary hover:text-accent mr-1">
                        <svg class="w-6 h-6">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#skype" />
                        </svg>
                    </a>
                    {{-- <a href="{{ Setting::get('weixin') }}" class="text-primary hover:text-accent mr-1">
                        <svg class="w-6 h-6">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#weixin" />
                        </svg>
                    </a> --}}
                </div>
                @include('front.elements.essential_trip_information')


                @if(iterator_count($trip->addon_trips))
                    <div class="mb-8">
                        <h2 class="mb-2 font-display text-2xl text-primary uppercase">Additional Tours</h2>
                        @forelse ($trip->addon_trips as $addon_trip)
                            @include('front.elements.addon_trip', ['trip' => $addon_trip])
                        @empty
                        @endforelse
                    </div>
                @endif



                <div class="sticky-top sticky-price none lg:block" style="top: 9rem;">
                    @include('front.elements.price_card')
                </div>

            </aside>
        </div>
    </div>

    <!-- Similar -->
    @if (!$trip->similar_trips->isEmpty())
        <div class="bg-light py-4 mb-20 ">
            <div class="container">
                <h2 class="text-4xl lg:text-5xl font-display text-primary uppercase">Similar Tours</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 md:gap-4">
                    @forelse ($trip->similar_trips as $trip)
                        @include('front.elements.tour-card', ['tour' => $trip])
                    @empty

                    @endforelse
                </div>
            </div>
        </div> <!-- Similar -->
    @endif
</section>
<div id="ex1" class="modal" style="max-width: 70%;">
  <p>
    <img class="map-image-modal" src="{{ $trip->mapImageUrl }}" alt="map">
  </p>
</div>

@endsection
@push('scripts')
<!--<script src="{{ asset('assets/front/js/tour-details.js') }}"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="https://cdn.jsdelivr.net/npm/wheelzoom@4.0.1/wheelzoom.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
<script>
    // jQuery.noConflict(true);
</script>
<script>
    wheelzoom(document.querySelector('.wheelzoom'))
</script>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const heroSlider = tns({
            container: '.hero-slider',
            nav: false,
            controlsContainer: '.hero-slider-controls > div',
            autoplay: true,
            autoplayButtonOutput: false
        })
        const monthSlider = tns({
            container: '.trips-month-slider',
            nav: false,
            controlsContainer: '.trips-month-slider-controls',
            autoplay: true,
            autoplayButtonOutput: false
        });


        // For scrollspy functionality
        const tdb = document.querySelector('.tdb')
        const sections = document.querySelectorAll('.tds')
        const sectionScrollObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                const link = tdb.querySelector(`[href="#${entry.target.id}"]`)
                if(entry.isIntersecting){
                    link.classList.add('bg-accent')
                } else {
                    link.classList.remove('bg-accent')
                }
            })
        }, {
                rootMargin: "-19% 0px -80% 0px"
        })
        sections.forEach(section => {
            sectionScrollObserver.observe(section)
        })

    })
window.onload = function() {

  var session_success_message = '{{ $session_success_message ?? '' }}';
  var session_error_message = '{{ $session_error_message ?? '' }}';
  if (session_success_message) {
    toastr.success(session_success_message);
  }

  if (session_error_message) {
    toastr.danger(session_error_message);
  }

  // Hero Slider
//   $(".tour-details-hero .owl-carousel").owlCarousel({
//     items: 1,
//     dots: false,
//     // autoplay: true,
//     // autoplayTimeout: 8000,
//     loop: true,
//     animateOut: 'fadeOut'
//   });

  // $("#review-modal").modal('show');

  //Display user image upon select
  const showImage = (src, target) => {
    var fr = new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function(e) {
      target.src = this.result;
    };
    src.addEventListener("change", function() {
      // fill fr with image data
      fr.readAsDataURL(src.files[0]);
    });
  }
  const src = document.getElementById("photo-input");
  const target = document.getElementById("write-review-photo");
//   showImage(src, target);

  //Control ratings
//   const stars = document.querySelectorAll('.select-ratings i')
//   const ratingsInput = document.querySelector('#ratings-input')
//   stars.forEach((star, index) => {
//     star.addEventListener('click', () => {
//       ratingsInput.value = index + 1
//       console.log(ratingsInput.value)
//       stars.forEach((star, indexx) => {
//         star.classList.remove('active')
//         if (indexx <= index) star.classList.add('active')
//       })
//     })
//   })
}
$(function() {
    function expandAll() {
    }

    $('#map-modal').on('show.bs.modal', function (e) {
      setTimeout(function() {
        let img = '<img class="img-fluid map-image-modal" src="{{ $mapImageUrl }}" alt="">';
        $("#map-modal").find(".modal-body").html(img);
        wheelzoom($('.map-image-modal'));
      }, 500);
    });
    // $(".similar-trip-rating").rating();
    // $("#review-rating").rating();
});
</script>
<script>
    $(function() {
        // var validator = $("#review-form").validate({
        //     ignore: "",
        //     rules: {
        //         'name': 'required',
        //         'country': 'required',
        //         'title': 'required',
        //         'review': 'required',
        //     },
        //     submitHandler: function(form, event) {
        //         event.preventDefault();
        //         if (grecaptcha.getResponse(1)) {
        //             var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Submitting...');
        //             setTimeout(() => {
        //                 form.submit();
        //             }, 500);
        //         }else{
        //             grecaptcha.reset(review_captcha);
        //             grecaptcha.execute(review_captcha);
        //         }
        //     },
        // });

        $(function() {
            $('#ex1').on($.modal.OPEN, function(event, modal) {
                $('.map-image-modal').attr('src', "{{ $mapImageUrl }}");
                wheelzoom($('.map-image-modal'));
            });

            $('#ex1').on($.modal.AFTER_CLOSE, function(event, modal) {
                $('.map-image-modal').attr('src', "");
                $('.map-image-modal').trigger('wheelzoom.reset');
            });
            $('#map-modal').on('show.bs.modal', function(e) {
                setTimeout(function() {
                    let img = '<img class="img-fluid map-image-modal" src="{{ $mapImageUrl }}" alt="">';
                    $("#map-modal").find(".modal-body").html(img);
                    wheelzoom($('.map-image-modal'));
                }, 500);
            });
            // $(".similar-trip-rating").rating();
            // $("#review-rating").rating();
        });
        var enquiry_validator = $("#enquiry-form").validate({
            ignore: "",
            rules: {
                'name': 'required',
                'email': 'required',
                'country': 'required',
                'phone': 'required',
                'message': 'required',
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.flex'));
                // error.append(element.closest('.form-group'));
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                $(form).find('#redirect-url').val('{!! route("front.trips.show", $trip->slug) !!}');
                if (grecaptcha.getResponse(0)) {
                    var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }else{
                    grecaptcha.reset(enquiry_captcha);
                    grecaptcha.execute(enquiry_captcha);
                }
            },
        });
    });
    function onSubmitReview(token) {
        $("#review-form").submit();
        return true;
    }

    function onSubmitEnquiry(token) {
        $("#enquiry-form").submit();
        return true;
    }

    let enquiry_captcha;
    let review_captcha;
    var CaptchaCallback = function() {
        enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {'sitekey' : '{!! config("constants.recaptcha.sitekey") !!}'});
        // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '{!! config("constants.recaptcha.sitekey") !!}'});
    };
</script>
<script>
    $(function() {
        $("#select-trip-departure-filter").on('change', function(event) {
            event.preventDefault();
            let url = "{!! route('front.trip-departures.filter') !!}";
            let e = $(this);
            let month = e.children("option:selected").val();
            let trip_id = "{!! $page_trip_id !!}";

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                data: {month: month, trip_id: trip_id},
                async: false,
                success: function(response) {
                    if (response.data != "") {
                        $("#departure-card-block").html(response.data);
                    } else {
                        $("#departure-card-block").html('No data to show.');
                    }
                }
            });
        });

        $("#banner-slider>.slide").each(function(i, v) {
            let img = new Image();
            let image_src = $(v).find('img').data('img');
            img.onload = function() {
                $(v).find('img').attr('src', image_src);
            }
            img.src = image_src;
            if (img.complete) img.onload();
        });

        const activitiesSlider = tns({
            container: '.activities-slider',
            nav: false,
            controlsContainer: '.activities-slider-controls',
            items: 2,
            gutter: 16,
            rewind: true,
            responsive: {
                768: {
                    items: 3
                },
                992: {
                    items: 5
                }
            }
        })

        const monthSlider = tns({
            container: '.trips-month-slider',
            nav: false,
            controlsContainer: '.trips-month-slider-controls',
            autoplay: true,
            autoplayButtonOutput: false
        })
    });
</script>
@endpush
