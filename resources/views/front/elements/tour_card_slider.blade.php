<div class="relative">
    <div class="grid lg:grid-cols-2 gap-4">
        <div>
            <img class="lazyload" data-src="{{ $tour->imageUrl }}" alt="{{ $tour->name }}" width="600" height="320">
        </div>
        <div>
            <h2 class="mb-2 text-3xl font-display uppercase">
                {{ $tour->name }}
            </h2>
            <p> {{ truncate(strip_tags($tour->trip_info['overview'])) }} </p>

            <div class="flex wrap mb-4">
                <div class="flex aic mr-2 p-2">
                    <svg class="w-6 h-6 mr-1">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}"></use>
                    </svg>
                    <div>
                        <div class="upper bold fs-xs">Duration</div>
                        <span class="fs-lg bold"> <?= $tour->duration; ?> </span> days
                    </div>
                </div>
                <div class="flex aic p-2">
                    <svg class="w-6 h-6 mr-1">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#emojihappy') }}"></use>
                    </svg>
                    <div>
                        <div class="upper bold fs-xs">Difficulty</div>
                        {{ $tour->difficulty_grade_value }}
                    </div>
                </div>
            </div>

            <div class="price mb-4">
                <div class="text-accent">
                    <span class="text-sm">
                        from
                    </span>
                    <s class="font-bold">
                        USD {{ number_format($tour->cost, 2) }}
                    </s>
                </div>
                <div class="font-display">
                    <span>USD</span>
                    @php
                        $price_arr = explode('.', number_format($tour->offer_price, 2));
                    @endphp
                    <span class="text-4xl">{{ $price_arr[0] }}</span>
                    <span>.{{ $price_arr[1] }}</span>
                </div>
            </div>

            <div>
                <a href="{{ route('front.trips.show', $tour->slug) }}" class="btn btn-accent">
                    Explore
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}"></use>
                    </svg>
                </a>
                {{-- <a href="tour-details.php" class="btn btn-gray">
                    Book Now
                </a> --}}
            </div>
        </div>
    </div>
</div>
