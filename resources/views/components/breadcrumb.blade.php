@props(['items'])

@php
    $breadcrumbItems = array_merge([['url' => route('home'), 'title' => __('Inici')]], $items);
@endphp

<div class="mb-6 flex items-center gap-3">
    @foreach ($breadcrumbItems as $item)
        @if (isset($item['url']))
            <a href="{{ $item['url'] }}" class="inline-flex items-center gap-2 hover:underline">
                @if ($item['title'] == __('Inici'))
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-3.5">
                        <path
                            d="M8.543 2.232a.75.75 0 0 0-1.085 0l-5.25 5.5A.75.75 0 0 0 2.75 9H4v4a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 1 1 2 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V9h1.25a.75.75 0 0 0 .543-1.268l-5.25-5.5Z" />
                    </svg>
                @endif
                <span>
                    {{ $item['title'] }}
                </span>
            </a>
        @else
            <span class="inline-block text-stone-400">{{ $item['title'] }}</span>
        @endif
        @if (!$loop->last)
            <span class="inline-block text-gray-500">/</span>
        @endif
    @endforeach
</div>
