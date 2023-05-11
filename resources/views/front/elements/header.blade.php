<?php
$success_message = "";
$error_message = "";
if (session()->has('success_message')) {
    $success_message = session()->get('success_message');
}

if (session()->has('error_message')) {
    $error_message = session()->get('error_message');
}
?>
@push('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
<!-- Header -->
<header class="header fixed flex items-end w-full pb-1" x-data="{searchboxOpen:false, mobilenavOpen:false}">
    <div class="container relative flex justify-between items-end w-full">

        <!-- Logo -->
        <a class="logo flex-shrink-0" href="https://www.nepaladventurepilgrimage.com">
            <img class="lazy" src="{{ asset('assets/front/img/logo.png') }}" class="block" alt="{{ config('app.name') }}" title="{{ config('app.name') }}" width="125" height="68">
        </a><!-- Logo -->

        <div class="flex items-end">
            <!-- Nav -->
            @include('front.elements.navbar')

            <!-- Search button -->
            <div class="ml-4">
                <button class="p-2" @click="searchboxOpen=true; setTimeout(() => $refs.headerSearchInput.focus(), 100)">
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#search" />
                    </svg>
                </button>
            </div><!-- Search button -->

            {{-- Mobile Nav Button --}}
            <div class="lg:none">
                <button class="p-2" @click="mobilenavOpen=!mobilenavOpen">
                    <svg class="w-6 h-6" x-show="!mobilenavOpen">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#menu" />
                    </svg>
                    <svg class="w-6 h-6" x-cloak x-show="mobilenavOpen">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#x" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Talk to experts --}}
        <div class="none xl:block ml-4 pb-2">
            <div class="flex justify-end items-center">
                <a href="tel:{{ Setting::get('mobile1') ?? '' }}">
                    <svg class="w-4 h-4">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                    </svg>
                    {{ Setting::get('mobile1') ?? '' }}
                </a>
                <a href="{{ Setting::get('viber') ?? '' }}" class="mr-1"><svg class="w-4 h-4">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                    </svg>
                </a>
                <a href="{{ Setting::get('whatsapp') ?? '' }}"><svg class="w-4 h-4">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                    </svg>
                </a>
            </div>
            <div>
                <a href="mailto:{{ Setting::get('email') ?? '' }}">
                    <svg class="w-4 h-4">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                    </svg>
                    {{ Setting::get('email') ?? '' }}
                </a>
            </div>
        </div>{{-- Talk to experts --}}

        {{-- Header Search --}}
        <form id="search-form" action="{{ route('front.trips.search') }}" method="GET" x-cloak x-show="searchboxOpen" class="header__searchform flex absolute" @click.away="searchboxOpen=false">
            <input type="search" style="z-index: 9999;" name="keyword" id="header-search" value="{{ request()->get('keyword') }}" placeholder="Search site" class="flex-grow-1 text-lg p-2 lg:p-4 bg-gray" x-ref="headerSearchInput">
            <button class="btn-accent p-4">
                <svg class="w-8 h-8">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright" />
                </svg>
            </button>
        </form>{{-- Header Search --}}
    </div>
</header><!-- Header -->
@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('assets/js/search-trips.js') }}"></script>
<script>
    (function() {
        let success_message = "<?php echo $success_message;?>";
        let error_message = "<?php echo $error_message;?>";
        if (success_message != "") {
            toastr.success(success_message);
        }
        if (error_message != "") {
            toastr.warning(error_message);
        }
    })();
</script>
@endpush
