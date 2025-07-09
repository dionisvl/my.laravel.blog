@extends('layout')

@section('content')
    <div class="w-full md:w-2/3 pr-0 md:pr-6">

        <form action="/search" method="POST" role="search" class="flex mb-6">
            {{ csrf_field() }}
            <input class="flex-grow px-4 py-2 border border-gray-600 bg-gray-800 text-white rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                   type="text" placeholder="Search" aria-label="Search" name="q">
            <button class="bg-gray-800 hover:bg-blue-500 text-blue-500 hover:text-white px-4 py-2 border border-blue-500 border-l-0 rounded-r-md transition-colors duration-200"
                    type="submit">Search
            </button>
        </form>

        @if($details->count() > 0)
            <div class="bg-green-900 border-l-4 border-green-500 text-green-300 p-4 mb-6" role="alert">
                The Search results for your query <b>{{ $query }}</b> are:
            </div>

            @foreach($details as $post)
                <article class="bg-gray-800 rounded-lg shadow-sm mb-6 overflow-hidden border border-gray-700">
                    <div class="flex flex-col md:flex-row">
                        <div class="flex-shrink-0 w-full md:w-32 flex items-center justify-center p-2">
                            <div class="h-12 w-full flex items-center justify-center overflow-hidden">
                                <img src="{{$post->getImage()}}" alt="{{$post->title}}"
                                     class="h-12 w-auto object-contain" loading="lazy">
                            </div>
                        </div>

                        <header class="flex-grow p-3">
                            <h3 class="text-lg font-semibold">
                                <a href="{{route('post.show', $post->slug, 0)}}"
                                   class="text-white hover:text-blue-400 transition">
                                    {{$post->title}}
                                </a>
                            </h3>
                        </header>
                    </div>

                    <div class="p-4 pt-0">
                        <div class="prose max-w-none mb-2">{{$post->description}}</div>
                        <div class="prose max-w-none text-sm text-gray-400 mb-4 search-element-body">{!! $post->content !!}</div>

                        <div class="flex justify-between items-center text-sm text-gray-400 pt-4 border-t border-gray-700">
                                        <span>
                                            By <a href="#" class="hover:text-blue-400">{{$post->author->name}}</a> On {{$post->getDate()}}
                                        </span>
                        </div>
                    </div>
                </article>
            @endforeach
        @else
            <div class="bg-yellow-900 border-l-4 border-yellow-500 text-yellow-300 p-4" role="alert">
                For your query <b>{{ $query }}</b> nothing found.
            </div>
        @endif
    </div>
    @include('pages._sidebar')
@endsection
