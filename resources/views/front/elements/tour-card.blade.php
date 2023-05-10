<div class="tour bg-white flex flex-col shadow-sm">
    <div class="top">
        <img class="lazyload" src="{{ $tour->imageUrl }}" alt="{{ $tour->name }}">
        <div class="top__overlay">
            <div class="location">
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" /></svg>
                <span><?= $tour->location; ?></span>
            </div>
        </div>
    </div>
    <div class="offer">{{ $tour->best_value }}</div>
    <div class="bottom flex flex-col flex-grow-1 justify-between">
        <div class="flex-grow-1 flex flex-col p-4">
            {{-- Activity badge --}}
            <div class="mb-2"><span class="mb-4 inline-block bg-light text-sm px-2 py-1 rounded-full">
                {{ $tour->trip_activity_type }}
                </span></div>

            {{-- Tour Name --}}
            <a href="{{ route('front.trips.show', ['slug' => $tour->slug])}}" class="flex-grow-1 mb-4"><h2 class="mb-2 font-display text-2xl text-primary uppercase">{{ $tour->name }}</h2></a>

            {{-- Duration / Grade --}}
            <div class="mb-4 details flex justify-center">
                <div class="pr-4 mr-4 border-right-light">
                    <div class="font-display text-gray text-sm uppercase">Duration</div>
                    <div class="flex items-center">
                        {{-- <svg class="w-6 h-6 flex-shrink-0 mr-2 text-primary">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#calendar" /></svg> --}}
                        <div class="flex items-center">
                            <span class="mr-2 text-4xl text-primary font-display">{{ $tour->duration }}</span> days
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-display text-gray text-sm uppercase">Grading</div>
                    <div class="flex items-center">
                            <svg "http://www.w3.org/2000/svg" viewbox="0 0 50 50" class="w-10 h-10 flex-shrink-0 mr-2 text-primary">
                                <circle cx="25" cy="25" r="20" fill="none" stroke="#ddd" stroke-width="10" />
                                @php
                                    $circ = 2 * pi() * 20
                                @endphp
                                @if (strtolower($tour->difficulty_grade_value) === 'easy')
                                <circle cx="25" cy="25" r="20" fill="none" stroke="#1b5" stroke-dasharray="{{ $circ / 3 }} {{ $circ / 3 * 2 }}" stroke-dashoffset="{{ $circ / 4 }}" stroke-width="10" />
                                @elseif (strtolower($tour->difficulty_grade_value) === 'moderate')
                                <circle cx="25" cy="25" r="20" fill="none" stroke="orange" stroke-dasharray="{{ $circ / 3 * 2 }} {{ $circ / 3}}" stroke-dashoffset="{{ $circ / 4 }}" stroke-width="10" />
                                @elseif (strtolower($tour->difficulty_grade_value) === 'difficult')
                                <circle cx="25" cy="25" r="20" fill="none" stroke="red" stroke-width="10" />
                                @endif
                            </svg>
                            {{-- <svg class="w-6 h-6 flex-shrink-0 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg> --}}
                            {{ $tour->difficulty_grade_value }}
                    </div>
                </div>
            </div>


            {{-- Action Buttons --}}
            <div class="flex justify-between items-end">

            {{-- Price --}}
                <div class="price">
                    <div class="mr-2 text-gray">
                        <span class="text-sm">
                            from
                        </span>
                        <s class="font-bold text-red">
                            USD {{ number_format($tour->cost, 2) }}
                        </s>
                    </div>
                    <div class="font-display text-primary">
                        <span>USD</span>
                        @php
                            $price_arr = explode('.', number_format($tour->offer_price, 2));
                        @endphp
                        <span class="text-4xl"> {{ $price_arr[0] }} </span>
                        <span class="text-2xl">.{{ $price_arr[1] }}</span>
                    </div>
                </div>
                <a href="{{ route('front.trips.show', ['slug' => $tour->slug]) }}" class="btn btn-primary">
                    Explore
                    <svg class="w-4 h-4">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright" /></svg>
                </a>
                {{-- <a href="{{ route('tours.book', ['slug' => $tour->slug]) }}" class="btn btn-accent">Book Now</a> --}}
            </div>

        </div>
        <div class="flex items-center bg-gray p-2">
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
            <span class="text-xs text-gray uppercase">based on 30 ratings</span>
        </div>
    </div>
</div>
