@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
@endpush

<section>
    <div class="hero relative">
        <!-- Slider -->
        <div id="banner-slider" class="hero-slider">
            @forelse ($block_1_trips as $banner)
                <div class="slide relative">
                    <img src="{{ $banner->thumbImageUrl }}" data-img="{{ $banner->imageUrl }}" class="block lazyload" alt="{{ $banner->name }}" width="1500" height="1000">
                    <div class="text absolute w-full py-4 lg:py-6">
                        <div class="container">
                            <h2 class="mb-2 font-display text-white text-8xl lg:text-4xl lg:text-5xl" style="
    font-size: calc(5vw + 1rem);">
                                <span>{{ $banner->name }}</span>
                            </h2>
                   
                
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- Slider -->

        <div class="hero-slider-controls none md:block absolute">
            <div class="container flex">
                <button>
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                    </svg>
                </button>
                <button>
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                    </svg>
                </button>
            </div>
        </div>
    </div><!-- Hero -->
</section>

@push ('scripts')
<script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>

<script>
    const heroSlider = tns({
        container: '.hero-slider',
        nav: false,
        controlsContainer: '.hero-slider-controls .container',
        autoplay: true,
        autoplayButtonOutput: false
    })
</script>
@endpush
