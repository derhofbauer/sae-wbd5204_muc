<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Single Post') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="errors">
            @foreach($errors->all() as $error)
                <div class="error">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="post flex-initial bg-white shadow-sm sm:rounded-lg p-2" id="{{ $post->id }}">
                        <div class="post__image">
                            <img src="{{ $post->image }}" alt="{{ $post->content }}" width="100%">
                        </div>
                        <div class="post__meta">
                            @auth
                                <div class="post__author">
                                    {{ $post->author->name }}
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

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
