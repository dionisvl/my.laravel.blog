@extends('layout')

@section('content')

    <div class="w-full md:w-3/4 pr-0 md:pr-6 space-y-3">
        <div class="p-4 rounded-lg mb-6">
            <h1 class="text-2xl font-semibold text-white mb-3">
                @isset($tag)
                    {{$tag->title}}
                @elseif(isset($category))
                    {{$category->title}}
                @endif
            </h1>
            <blockquote class="text-gray-300">
                all posts by filter
            </blockquote>
        </div>
        @foreach($posts as $post)
            <article class="bg-gray-800 rounded-lg shadow-sm overflow-hidden border border-gray-700">
                <a href="{{route('post.show', $post->slug)}}"
                   class="flex flex-col transition-all duration-200 hover:bg-gray-700 hover:shadow-md">

                    <div class="flex flex-row">
                        <div class="flex-shrink-0 w-32 flex items-center justify-center p-1">
                            <div class="h-12 w-full flex items-center justify-center overflow-hidden">
                                <img src="{{$post->getImage()}}" alt="{{$post->title}}"
                                     width="100" height="50"
                                     class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-110"
                                     loading="lazy">
                            </div>
                        </div>

                        <header class="flex-grow flex items-center p-1 px-3">
                            <h3 class=" text-lg font-semibold text-white group-hover:text-blue-400 transition">
                                {{$post->title}}
                            </h3>
                        </header>
                    </div>

                    @if(!empty($post->description))
                        <div class="px-4 pb-4">
                            <div class="prose max-w-none text-gray-300 text-sm line-clamp-2 hover:text-blue-400 transition-colors">
                                {!!$post->description!!}
                            </div>
                        </div>
                    @endif
                </a>

                <div class="flex justify-between items-center text-sm text-gray-400 pl-4 p-1 border-t border-gray-700">
                    <span>
                        By <a href="#" class="hover:text-blue-400">{{$post->author['name']}}</a>
                        on {{$post->getDate()}}
                    </span>

                    <div class="flex flex-wrap items-center space-x-0 sm:space-x-4 sm:mr-4">
                        <span class="flex items-center w-full sm:w-auto">
                            <i class="fas fa-eye mr-1"></i> {{$post->getViewsCount()}}
                        </span>
                    </div>
                </div>
            </article>
        @endforeach

        <div class="mt-8">
            {{$posts->links()}}
        </div>
    </div>

    @include('pages._sidebar')
@endsection
