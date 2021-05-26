<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="posts max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($posts as $post)
            <div class="post" id="{{ $post->id }}">
                <div class="post__image">
                    <img src="{{ $post->image }}" alt="{{ $post->content }}">
                </div>
                <div class="post__meta">
                    <div class="post__author">
                        {{ $post->author->name }}
                    </div>
                    <div class="post__date">
                        {{--@todo: diffForHuman?!!!!111!!elf!--}}
                        {{ $post->created_at->format('d.m.Y H:i') }}
                    </div>
                </div>
                <div class="post__text">
                    {{ $post->content }}
                </div>
                <div class="post__more">
                    <a href="{{ route('posts.show', ['post' => $post]) }}">More</a>

                    @can('update', $post)
                        <a href="{{ route('posts.edit', ['post' => $post]) }}">Edit</a>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
