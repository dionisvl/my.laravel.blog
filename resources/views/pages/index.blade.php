@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">

                <?/* old template search
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
                            <?// if ($post->getImage() != '/img/no-image.png') {?>
                            <div class="post-thumb" style="
        flex-direction: row;
        justify-content: start;
">
                                <a class='post_image_block' href="{{route('post.show', $post->slug)}}">
                                    <img src="{{$post->getImage()}}" alt="">
                                </a>

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
                                    <ul class="text-center pull-right">
                                        <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                        {{--<script src="//yastatic.net/share2/share.js"></script>--}}
                                        {{--<div class="ya-share2" data-services="vkontakte,facebook,twitter,linkedin,telegram" data-limit="3"></div>--}}
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