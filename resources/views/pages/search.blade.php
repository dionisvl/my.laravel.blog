@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 flow-main">

                    <form action="/search" method="POST" role="search" class="form-inline mr-auto mb-4">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"
                                   name="q">
                        </div>
                        <button class="btn btn-outline-primary btn-rounded btn-sm my-0 waves-effect waves-light"
                                type="submit">Search
                        </button>
                    </form>

                    @if($details->count() > 0)
                        <div class="alert alert-success mb-3" role="alert">
                            The Search results for your query <b>{{ $query }}</b> are:
                        </div>
                        @foreach($details as $post)
                            <article class="post">
                                <div class="post-thumb">
                                    <div class='post_image_block'>
                                        <img src="{{$post->getImage()}}" alt="{{$post->title}}" loading="lazy">
                                    </div>

                                    <a href="{{route('post.show', $post->slug)}}"
                                       class="post-thumb-overlay text-center">
                                        <div class="text-uppercase text-center">View Post</div>
                                    </a>
                                    <header style='flex-grow:2;' class="entry-header text-uppercase">
                                        <h3 class="entry-title">
                                            <a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a>
                                        </h3>
                                    </header>
                                </div>
                                <div class="post-content">
                                    <div class="entry-content">{{$post->description}}</div>
                                    <div class="entry-content search-element-body">{!! $post->content !!}</div>
                                    <div class="social-share social-share-title">
                                    <span class=" pull-left">
                                        By <a href="#">{{$post->author->name}}</a> On {{$post->getDate()}}
                                    </span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <div class="alert alert-warning" role="alert">
                            For your query <b>{{ $query }}</b> nothing found.
                        </div>
                    @endif
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
