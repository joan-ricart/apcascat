@props(['date'])

<p {{ $attributes->merge(['class' => 'text-stone-500']) }} {{ $attributes }}>{{ $date }}</p>
