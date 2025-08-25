@extends('layouts.sidebar')

@section('title', __('Noticias'))

@section('content')
    <h1 class="mb-6 text-2xl font-bold">{{ __('Noticias') }} APCAS Catalunya</h1>

    <div id="posts-container" class="grid grid-cols-2 items-stretch gap-4">
        <x-posts.list :posts="$posts->items()" />
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
