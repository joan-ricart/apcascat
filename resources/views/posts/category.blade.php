@extends('layouts.sidebar')

@section('title', __('Noticias'))

@section('content')
    <header>
        <h1 class="text-lg font-bold">{{ $postCategory->name }}</h1>
    </header>

    <div id="posts-container" class="grid gap-6">
        @foreach ($posts as $post)
            <x-posts.card :post="$post" />
        @endforeach
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
    <x-sidebar.categories />
    <x-sidebar.recent-posts limit="5" />
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
