@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">

                <?php /* old template search
                <div class="col-md-12 widget search">
                    <form action="/search" method="POST" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control" name="q"
                                   placeholder="Search text there">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                */?>
                <div class="col-md-8">
                    @foreach($posts as $post)
                        <article class="post">
                            <?// if ($post->getImage() != '/storage/blog_images/no-image.png') {?>
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
                            <?//}?>
                            <div class="post-content">

                                <div class="entry-content">
                                    {!!$post->description!!}
                                    <?/*
                                    <div class="btn-continue-reading text-center text-uppercase">
                                        <a href="{{route('post.show', $post->slug)}}" class="more-link">Continue
                                            Reading</a>
                                    </div>
                                    */?>
                                </div>
                                <div class="social-share">
                            <span class="social-share-title pull-left text-capitalize">
                                By <a href="#">{{$post->author->name}}</a> On {{$post->getDate()}}
                            </span>
                                    {{--<script src="//yastatic.net/share2/share.js"></script>--}}
                                    {{--<div class="ya-share2" data-services="vkontakte,facebook,twitter,linkedin,telegram" data-limit="3"></div>--}}
                                    <ul class="text-center pull-right">
                                        <li>
                                                <i class="fa fa-eye"> {{$post->getViewsCount()}}</i>
                                        </li>

                                    </ul>

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
