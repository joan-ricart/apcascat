@props(['items'])

@php
    $breadcrumbItems = array_merge([['url' => route('home'), 'title' => __('Inici')]], $items);
@endphp

<div class="mb-6 line-clamp-1 text-brand-gray">
    @foreach ($breadcrumbItems as $item)
        @if (isset($item['url']))
            <a href="{{ $item['url'] }}" class="hover:underline text-black">{{ $item['title'] }}</a>
        @else
            {{ $item['title'] }}
        @endif
        @if (!$loop->last)
            <span class="inline-block text-gray-500">/</span>
        @endif
    @endforeach
</div>
