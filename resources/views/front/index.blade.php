@extends('layouts.front')
@push('styles')
<style>
    .showMore {
        max-height: 460px;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;"
    }
</style>
@endpush
@section('content')

<!-- Slider -->
@include('front.elements.banner')


<!-- About -->
<div class="about bg-gray">
    <div class="container">
        <div class="grid lg:grid-cols-3">
            <div class="about__bg bg-gray">
            </div>
            <div id="overview-content-block" class="lg:col-span-2 p-4 lg:p-10 about__text py-10 showMore">
                <h1 class="mb-2 text-4xl lg:text-4xl text-primary font-display uppercase">{{ Setting::get('homePage')['welcome']['title']??'' }}
                </h1>
                <div class="underline underline--left mb-6 bg-accent"></div>
                <?= Setting::get('homePage')['welcome']['content']??'' ?>

              
            </div>
            <div class="about__image lg:pr-8">
                <div id="TA_selfserveprop549" class="TA_selfserveprop">
<ul id="PnaDZYvvPq" class="TA_links NxaKtpHbd">
<li id="M0aCKBYzYkQ" class="uKrii7h9"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g293890-d11964139-Reviews-Nepal_Adventure_Pilgrimage_Treks_and_Expedition_Pvt_Ltd-Kathmandu_Kathmandu_Vall.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a></li>
</ul>
</div>
<p><script async src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=549&amp;locationId=11964139&amp;lang=en_US&amp;rating=true&amp;nreviews=4&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=true&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script></p>
            </div>
        </div>
    </div>
    <div class="activities py-0" style="position: relative; top: -70px;">
        <div class="container">
            <button style="padding-left: 25%;" id="show-more-btn" data-status="false">show more</button>
        </div>
    </div>
</div><!-- About -->



{{-- Activities --}}
<div class="activities py-10">
    <div class="container">
        <div class="lg:flex justify-between items-center mb-4">
            <div>
                <h2 class="text-4xl lg:text-5xl font-display text-primary uppercase">Things To Do in Nepal</h2>
                <div class="underline mb-6 bg-accent"></div>
            </div>
            <div class="activities-slider-controls">
                <button>
                    <svg class="w-6 h-6 text-accent">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                    </svg>
                </button>
                <button>
                    <svg class="w-6 h-6 text-accent">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="activities-slider">

            @foreach ($activities as $activity)
                @include('front.elements.activity-card', ['activity' => $activity])
            @endforeach
        </div>
    </div>
</div>{{-- Activities --}}

<!-- Popular right now -->
<div class="featured py-10 bg-gray">
    <div class="container">

        <div class="lg:flex justify-between items-center mb-4">
            <div>
                <h2 class="text-4xl lg:text-5xl font-display text-primary uppercase">{{ Setting::get('homePage')['trip_block_2']['title'] ?? '' }}</h2>
                <div class="underline mb-6 bg-accent"></div>
            </div>
            
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">

            @forelse ($block_2_trips as $block_2_tour)
                @include('front.elements.tour-card', ['tour' => $block_2_tour])
            @empty
            @endforelse
        </div>
        <a href="{{ route('front.trips.listing') }}" class="theme">
                View all
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg#chevronright') }}" />
                </svg>
        </a>
    </div>
</div> <!-- Popular right now -->

<!-- Reviews -->
<div class="reviews py-10">
    <div class="container">

        <div class="lg:flex justify-between items-center mb-4">
            <div>
                <h2 class="text-4xl lg:text-5xl font-display text-primary uppercase">Reviews from our
                    customers</h2>
                <div class="underline mb-6 bg-accent"></div>
            </div>
            <a href="{{ route('front.reviews.index') }}" class="text-accent">
                View all
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg#chevronright') }}" />
                </svg>
            </a>
        </div>

        <div class="grid lg:grid-cols-2 gap-2 lg:gap-3">
            @forelse ($reviews as $review)
                <div class="review p-4">
                    <div class="review__content">
                        <h2 class="mb-2 font-display text-2xl text-primary">{{ $review->title }}</h2>
                        <p>{{ $review->review }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="mr-2">
                            <img src="{{ $review->thumbImageUrl }}" alt="">
                        </div>
                        <div>
                            <div class="font-bold">{{ ucfirst($review->review_name) }}</div>
                            <div class="text-sm text-gray">{{ $review->review_country }}</div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div><!-- Reviews -->

<!-- Trip of the month -->
<div class="py-10 bg-gray text-black">
    <div class="container">

        <div class="lg:flex justify-between items-center mb-4">
            <h2 class="text-4xl lg:text-5xl font-display uppercase">{{ Setting::get('homePage')['trip_block_3']['title'] ?? '' }}
            </h2>

            <div class="trips-month-slider-controls">
                <button>
                    <svg class="w-6 h-6 text-accent">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                    </svg>
                </button>
                <button>
                    <svg class="w-6 h-6 text-accent">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="trips-month-slider">
            @forelse ($block_3_trips as $block3tour)
                @include('front.elements.tour_card_slider', ['tour' => $block3tour])
            @empty
            @endforelse
        </div>
    </div>
</div>

<!-- Departure Dates -->
<div class="departure-dates section p-4">
    <div class="container">
        <div class="flex wrap jcsb aic">
             <h2 class="text-4xl lg:text-5xl font-display text-primary uppercase">Upcoming Departures
                </h2>
        </div>
        <div class="bg-white">
            <!-- <h2>Date & Price</h2> -->
            <!-- <h3>Upcoming Departure Dates</h3> -->
            <div class="table-wrapper-scroll">
                <table class="table mb-2">
                    <thead>
                        <th class="upper text-left">Package</th>
                        <th class="upper text-left">Date</th>
                        <th class="upper text-left">Price</th>
                        <th class="upper text-left">Seats Left</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($departures as $departure)
                            <tr>
                                <td>
                                    <a href="{{ route('front.trips.show', $departure->trip->slug) }}">
                                        <?= $departure->trip->name; ?>
                                    </a>
                                </td>
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
                                            <small class="text-gray"><s>USD {{ number_format($departure->trip->cost) }}</s></small><br>
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
                                <td><a href="{{ route('front.trips.departure-booking', ['slug' => $departure->trip->slug, 'id' => $departure->id]) }}" class="btn btn-sm btn-accent">Join Group</a></td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <!-- <p class="text-center"><button id="more-dates" class="btn btn-sm btn-gray">See more dates</button></p> -->
            </div>
        </div>
    </div>
</div><!-- Departure Dates -->


<!-- Blog -->
<div class="blog bg-gray p-4">
    <div class="container">
        <div>
                <h2 class="text-4xl lg:text-5xl font-display text-primary uppercase">Blogs
                </h2>
                <div class="underline mb-6 bg-accent"></div>
            </div>
        <div class="grid lg:grid-cols-3 gap-2 lg:gap-6">
            @forelse ($blogs as $blog)

                <a href="{{ route('front.blogs.show', $blog->slug) }}">
                    <div class="article">
                        <div class="image">
                            <img data-src="{{ $blog->medium_imageUrl }}" alt="{{ $blog->name }}" class="lazyload"  title="{{ $blog->name }}" width="300" height="200">
                        </div>
                        <div class="content">
                            <h2>{{ $blog->name }}</h2>
                            <div class="flex items-center text-xs text-gray"><svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ formatDate($blog->blog_date) }}
                            </div>
                           
                        </div>
                    </div>
                </a>
            @empty
            @endforelse
        </div>
        <a href="" class="theme">Go to blog
            <svg>
                <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
            </svg>
        </a>
    </div>
</div><!-- Blog -->


@include('front.elements.search_widget')

@endsection

@push('scripts')
<script>
    $(function() {
        $("#select-trip-departure-filter").on('change', function(event) {
            event.preventDefault();
            let url = "{!! route('front.trip-departures.filter') !!}";
            let e = $(this);
            let month = e.children("option:selected").val();

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                data: {month: month},
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
        });
        
        $("#show-more-btn").on('click', function(event) {
            var e = $(this);
            var status = e.data('status');
            if (status == false) {
                e.data('status', true);
                $("#overview-content-block").removeClass('showMore');
                e.html('show less');
            } else {
                $("#overview-content-block").addClass('showMore');
                e.data('status', false);
                e.html('show more');
            }
        });
    });
</script>
@endpush
