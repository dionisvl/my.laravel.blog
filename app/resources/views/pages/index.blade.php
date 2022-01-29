@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 flow-main">
                    @foreach($posts as $post)
                        <article class="post">
                            <div class="post-thumb">
                                <div class='post_image_block'>
                                    <img src="{{$post->getImage()}}" alt="{{$post->title}}" loading="lazy">
                                </div>

                                <a href="{{route('post.show', $post->slug)}}" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                                <header style='flex-grow:2;' class="entry-header text-uppercase">
                                    <h3 class="entry-title">
                                        <a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a>
                                    </h3>
                                </header>
                            </div>
                            <div class="post-content">
                                <div class="entry-content">{!!$post->description!!}</div>

                                <div class="social-share social-share-title">
                                    <span class=" pull-left">
                                        By <a href="#">{{$post->author['name']}}</a> On {{$post->getDate()}}
                                    </span>
                                    <span class="float-right">
                                        <span class="pl-2"><i class="fas fa-eye"></i> {{$post->getViewsCount()}}</span>
                                        <a class="pl-2 like" onclick="Likes.toggle(this,event);"
                                           data-post_id="{{$post->id}}" href="#" title="Like">
                                            <i class="@if ($post->is_liked) fas @else far @endif fa-heart"
                                               style="color: red;"></i>
                                            <span class="like_button_count">{{$post->likes_count}} </span>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endforeach

                    {{$posts->links()}}
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
