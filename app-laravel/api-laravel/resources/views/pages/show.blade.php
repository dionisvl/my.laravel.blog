@extends('layout')

@section('content')
    <div class="w-full md:w-3/4 pr-0 md:pr-6">
        <article class="bg-gray-800 rounded-lg shadow-sm overflow-hidden border border-gray-700">
            @if(!empty($post->getImage()))
                <div class="w-full h-64 md:h-96 flex items-center justify-center bg-gray-700">
                    <img src="{{$post->getImage()}}" alt="{{$post->title}}"
                         height="384"
                         class="w-full h-full object-contain">
                </div>
            @endif

            <div class="p-6">
                <header class="text-center mb-6">
                    @if($post->category)
                        <h6 class="text-sm mb-2">
                            <a href="{{route('blog.category.show', $post->category->slug)}}"
                               class="text-blue-500 hover:text-blue-700">{{$post->category->title}}</a>
                        </h6>
                    @endif
                        <h1 class="text-3xl font-bold text-white mb-2">{{$post->title}}</h1>
                </header>

                <div class="prose max-w-none">
                    {!! $post->content !!}
                </div>

                @if(!empty($aphorism))
                    <div class="mt-8">
                        <h4 class="font-semibold mb-2">Афоризм дня:</h4>
                        <div class="border-2 rounded-sm p-2 m-2 flex items-center bg-gray-700 text-white">
                            {{ $aphorism->detail_text }} ({{ $aphorism->id }})
                        </div>
                    </div>
                @endif

                <div class="flex flex-wrap mt-6 mb-4">
                    @foreach($post->tags as $tag)
                        <a href="{{route('tag.show', $tag->slug)}}"
                           class="bg-gray-700 hover:bg-gray-600 px-3 py-1 rounded-full text-sm mr-2 mb-2 transition text-white">{{$tag->title}}</a>
                    @endforeach
                </div>

                <div class="flex justify-between items-center text-sm text-gray-400 pt-4 border-t border-gray-700">
                    <span>
                        @if(!empty($post->author->name))
                            By <a href="#" class="hover:text-blue-400">{{$post->author->name}}</a>
                        @endif
                        On <b>{{$post->getDate()}}</b>
                    </span>

                    <div class="flex items-center">
                        <span class="flex items-center mr-4">
                            <i class="fas fa-eye mr-1"></i> {{$post->getViewsCount()}}
                        </span>
                        <a class="flex items-center w-full sm:w-auto group"
                           onclick="Likes.toggle(this,event);"
                           data-post_id="{{$post->id}}"
                           href="#"
                           title="Like">
                            <i class="@if ($post->is_liked) fas @else far @endif fa-heart text-red-500 mr-1 heart-icon transition-transform duration-500">
                            </i>
                            <span class="like_button_count transition-colors duration-500 group-hover:text-blue-400">
                                {{$post->likes_count}}
                            </span>
                        </a>

                        <div class="ml-4">
                            <script src="//yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-services="facebook,twitter,linkedin,telegram"></div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Comments Section -->
        <div class="mt-8">
            @foreach($post->getComments() as $comment)
                <div class="bg-gray-800 p-4 mb-4 rounded-lg border border-gray-700 flex">
                    <div class="mr-4 flex-shrink-0">
                        <img class="rounded-full w-12 h-12 object-cover" src="{{$comment->getAuthorImage()}}"
                             alt="{{$comment->author_name}}">
                    </div>
                    <div>
                        <h5 class="font-semibold text-white">{{$comment->author_name}}</h5>
                        <p class="text-xs text-gray-400 mb-2">{{$comment->created_at->diffForHumans()}}</p>
                        <p class="text-gray-300">{{$comment->text}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Comment Form -->
        <div class="bg-gray-800 p-6 mt-8 rounded-lg border border-gray-700">
            <h4 class="text-xl font-semibold mb-4">Leave a reply</h4>

            @include('admin.errors')

            <form class="w-full" role="form" method="post" action="/comment">
                {{csrf_field()}}
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="mb-4">
                    <x-inputs.honeypot/>
                    <x-inputs.countme/>
                    <textarea required
                              class="w-full border border-gray-600 bg-gray-700 text-white rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                              rows="4" name="message" placeholder="Write some comment"
                              onkeyup="count_keyup()"></textarea>
                </div>
                <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md transition duration-200 font-medium">
                    Post Comment
                </button>
            </form>
        </div>

        <!-- Previous/Next Navigation -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
            <div>
                @if(!empty($previous))
                    <a href="{{route('post.show', $previous->slug)}}"
                       class="block relative rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                        <img src="{{$previous->getImage()}}" alt="{{$previous->title}}"
                             class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-start p-4">
                            <div class="text-white">
                                <i class="fa fa-angle-left mr-1"></i>
                                <h5 class="font-semibold">{{$previous->title}}</h5>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
            <div>
                @if(!empty($next))
                    <a href="{{route('post.show', $next->slug)}}"
                       class="block relative rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                        <img src="{{$next->getImage()}}" alt="{{$next->title}}" class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-end p-4">
                            <div class="text-white text-right">
                                <h5 class="font-semibold">{{$next->title}}</h5>
                                <i class="fa fa-angle-right ml-1"></i>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>

    @include('pages._sidebar')
@endsection
