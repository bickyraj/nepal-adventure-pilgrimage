<div class="destination relative">
    <a href="{{ route('front.destinations.show', $destination->slug) }}">
        <div class="destination__img"><img class="lazyload" data-src="{{ $destination->thumb_imageUrl }}" class="block" alt="{{ $destination->name }}" title="{{ $destination->name }}" width="300" height="300"></div>
        <div class="absolute text bg-white px-4 py-2 text-center shadow-sm">
            <h2 class="font-bold">{{ $destination->name }}</h2>
            <div class="text-gray text-sm">{{ $destination->trips->count() }} tours</div>
        </div>
    </a>
</div>
