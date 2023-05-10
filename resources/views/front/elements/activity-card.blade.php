<div>
    <a href="{{ route('front.activities.show', $activity->slug) }}" class="activity">
        <div class="relative">
            <img class="lazyload" data-src="{{ $activity->thumb_imageUrl }}" alt="{{ $activity->name }}" class="block w-full" title="{{ $activity->name }}" width="240" height="240">
            <div class="text absolute text-white px-2 py-4">
                <h2 class="font-display uppercase">{{ $activity->name }}</h2>
                <div class="tours">
                    <span class="fs-xl bold">{{ $activity->trips->count() }}</span>
                    <span class="fs-sm">tours</span>
                </div>
            </div>
        </div>
    </a>
</div>
