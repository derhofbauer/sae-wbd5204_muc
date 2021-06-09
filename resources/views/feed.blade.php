<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($heading)
                {{ $heading }}
            @else
                {{ __('Posts') }}
            @endif
        </h2>

        <div id="react-app"></div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @auth
                        {{ __('You\'re logged in!') }}
                    @else
                        {{ __('You need to log in to add a post!') }}
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="posts max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="post-container flex flex-wrap space-x-2 space-y-2">
            @foreach($posts as $post)
                <div class="post flex-initial bg-white shadow-sm sm:rounded-lg p-2" id="{{ $post->id }}">
                    <div class="post__image">
                        <img src="{{ $post->image }}" alt="{{ $post->content }}" width="250px">
                    </div>
                    <div class="post__meta">
                        @auth
                            <div class="post__author">
                                <a href="{{ route('profile', ['user' => $post->author]) }}">{{ $post->author->name }}</a>
                            </div>
                        @endauth
                        <div class="post__date">
                            {{ $post->diffForHumans }}
                        </div>
                    </div>
                    <div class="post__text">
                        {{ $post->content }}
                    </div>
                    <div class="post__more">
                        <a href="{{ route('posts.show', ['post' => $post]) }}">{{ __('More') }}</a>

                        @can('update', $post)
                            <a href="{{ route('posts.edit', ['post' => $post]) }}">{{ __('Edit') }}</a>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>

        {{ $posts->links() }}
    </div>

</x-app-layout>
