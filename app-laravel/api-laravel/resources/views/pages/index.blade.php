@extends('layout')

@section('content')
    <div class="w-full md:w-3/4 pr-0 md:pr-6 space-y-3">
        @foreach($posts as $post)
            <article class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                <!-- Wrap the entire article in an anchor tag -->
                <a href="{{route('post.show', $post->slug, 0)}}"
                   class="flex flex-col transition-all duration-200 hover:bg-blue-50 hover:shadow-md">

                    <!-- First row: Image and Title -->
                    <div class="flex flex-row">
                        <!-- Post thumbnail with controlled height -->
                        <div class="flex-shrink-0 w-32 flex items-center justify-center p-2">
                            <div class="h-12 w-full flex items-center justify-center overflow-hidden">
                                <img src="{{$post->getImage()}}" alt="{{$post->title}}"
                                     width="75" height="50"
                                     class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-110"
                                     loading="lazy">
                            </div>
                        </div>

                        <!-- Post header -->
                        <header class="flex-grow p-3">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-500 transition">
                                {{$post->title}}
                            </h3>
                        </header>
                    </div>

                    <!-- Second row: Description -->
                    @if(!empty($post->description))
                        <div class="px-4 pb-4">
                            <div class="prose max-w-none text-gray-600 text-sm line-clamp-2 hover:text-blue-700 transition-colors">
                                {!!$post->description!!}
                            </div>
                        </div>
                    @endif
                </a>

                <!-- Post metadata -->
                <div class="flex justify-between items-center text-sm text-gray-600 pl-4 p-2 border-t border-gray-200">
                    <span>
                        By <a href="#" class="hover:text-blue-500">{{$post->author['name']}}</a>
                        on {{$post->getDate()}}
                    </span>

                    <div class="flex flex-wrap items-center space-x-0 sm:space-x-4 sm:mr-4">
                        <span class="flex items-center w-full sm:w-auto">
                            <i class="fas fa-eye mr-1"></i> {{$post->getViewsCount()}}
                        </span>
                        <a class="flex items-center w-full sm:w-auto group"
                           onclick="Likes.toggle(this,event);"
                           data-post_id="{{$post->id}}"
                           href="#"
                           title="Like">
                            <i class="@if ($post->is_liked) fas @else far @endif fa-heart text-red-500 mr-1 heart-icon transition-transform duration-500">
                            </i>
                            <span class="like_button_count transition-colors duration-500 group-hover:text-blue-500">
                                {{$post->likes_count}}
                            </span>
                        </a>
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
