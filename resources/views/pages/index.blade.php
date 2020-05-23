@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
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
                                    <h1 class="entry-title">
                                        <a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a>
                                    </h1>
                                </header>
                            </div>
                            <div class="post-content">
                                <div class="entry-content">{!!$post->description!!}</div>

                                <div class="social-share">
                                    <span class="social-share-title pull-left">
                                        By <a href="#">{{$post->author->name}}</a> On {{$post->getDate()}}
                                    </span>
                                    <span class="float-right">
                                        <span class="pl-2"><i class="fas fa-eye"></i> {{$post->getViewsCount()}}</span>
                                        <span class="pl-2"><i class="far fa-heart" style="color: red;"></i> {{$post->getViewsCount()}}</span>
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
