@extends('layouts.sidebar')

@section('title', __('Noticias'))

@section('content')
    <x-breadcrumb :items="[['url' => route('posts.index'), 'title' => __('Noticias')], ['title' => $postCategory->name]]" />

    <header class="mb-6">
        <h1 class="mb-1 text-2xl font-bold lg:text-3xl">{{ $postCategory->name }}</h1>
        <p class="text-sm text-stone-500 md:text-base">{{ __('Mostrant les noticíes més recents de la categoría') }} {{ $postCategory->name }}</p>
    </header>

    <div id="posts-container">
        <x-posts.list :posts="$posts" />
    </div>

    @if ($posts->hasMorePages())
        <div class="mt-8 text-center">
            <button id="load-more-button" data-next-page-url="{{ $posts->nextPageUrl() }}"
                class="rounded-lg border bg-black px-10 py-3 text-[15px] font-semibold text-white shadow hover:bg-black/90">
                {{ __('Cargar más') }}
            </button>
        </div>
    @endif
@endsection

@section('sidebar')
    <div class="space-y-6">
        <x-sidebar.recent-posts />
        <x-sidebar.categories />
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreButton = document.getElementById('load-more-button');
            const postsContainer = document.getElementById('posts-container');

            if (loadMoreButton) {
                loadMoreButton.addEventListener('click', function() {
                    let nextPageUrl = loadMoreButton.dataset.nextPageUrl;

                    if (nextPageUrl) {
                        fetch(nextPageUrl, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                postsContainer.insertAdjacentHTML('beforeend', data.posts);
                                loadMoreButton.dataset.nextPageUrl = data.next_page_url;

                                if (!data.next_page_url) {
                                    loadMoreButton.style.display = 'none';
                                }
                            })
                            .catch(error => console.error('Error loading more posts:', error));
                    }
                });
            }
        });
    </script>
@endpush
