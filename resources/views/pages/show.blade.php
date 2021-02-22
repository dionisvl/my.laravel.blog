@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 flow-main">
                    <article class="post">
                        @if(!empty($post->getImage()))
                            <div class="post-detail-thumb">
                                <img src="{{$post->getImage()}}" alt="">
                            </div>
                        @endif
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                @if($post->category)
                                    <h6>
                                        <a href="{{route('blog.category.show', $post->category->slug)}}"> {{$post->category->title}}</a>
                                    </h6>
                                @endif
                                <h1 class="entry-title">{{$post->title}}</h1>
                            </header>
                            <div class="entry-content">
                                {!! $post->content !!}
                            </div>
                            @if(!empty($aphorism))
                                <div>Афоризм дня:</div>
                                <div class="border-2 rounded-sm p-2 m-2 flex items-center bg-gray-200">
                                    {{ $aphorism->detail_text }} ({{ $aphorism->id }})
                                </div>
                            @endif
                            <div class="decoration">
                                @foreach($post->tags as $tag)
                                    <a href="{{route('tag.show', $tag->slug)}}"
                                       class="btn btn-default">{{$tag->title}}</a>
                                @endforeach
                            </div>
                            <div class="social-share">
                                <span class="social-share-title pull-left">
                                    @if(!empty($post->author->name))
                                    By <a href="#">{{$post->author->name}}</a>
                                    @endif On <b>{{$post->getDate()}}</b>
                                </span>

                                <span class="float-right">
                                    <span class="pl-2">
                                        <i class="fas fa-eye"></i> {{$post->getViewsCount()}}
                                    </span>
                                    <a class="pl-2 like" onclick="Likes.toggle(this,event);"
                                       data-post_id="{{$post->id}}" href="#" title="Like">
                                            <i class="@if ($post->is_liked) fas @else far @endif fa-heart"
                                               style="color: red;"></i>
                                            <span class="like_button_count">{{$post->likes_count}} </span>
                                    </a>
                                </span>

                                <ul class="text-center float-right">
                                    <script src="//yastatic.net/share2/share.js"></script>
                                    <div class="ya-share2"
                                         data-services="vkontakte,facebook,twitter,linkedin,telegram"></div>
                                </ul>
                            </div>
                        </div>
                    </article>
                    @foreach($post->getComments() as $comment)
                        <div class="bottom-comment">
                            <div class="comment-img">
                                <img class="img-circle" src="{{$comment->getAuthorImage()}}" alt="" width="75"
                                     height="75">
                            </div>
                            <div class="comment-text">
                                <h5>{{$comment->author_name}}</h5>
                                <p class="comment-date">{{$comment->created_at->diffForHumans()}}</p>
                                <p class="para">{{$comment->text}}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="leave-comment">
                        <h4>Leave a reply</h4>

                        @include('admin.errors')

                        <form class="form-horizontal contact-form" role="form" method="post" action="/comment">
                            {{csrf_field()}}
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <x-inputs.honeypot/>
                                    <x-inputs.countme/>
                                    <textarea required class="border form-control" rows="4" name="message"
                                              placeholder="Write some comment" onkeyup="count_keyup()"></textarea>
                                </div>
                            </div>
                            <button class="btn send-btn">Post Comment</button>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            @if(!empty($previous))
                                <div class="single-blog-box">
                                    <a href="{{route('post.show', $previous->slug)}}">
                                        <img src="{{$previous->getImage()}}" alt="">
                                        <div class="overlay">
                                            <div class="promo-text">
                                                <p><i class=" pull-left fa fa-angle-left"></i></p>
                                                <h5>{{$previous->title}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if(!empty($next))
                                <div class="single-blog-box">
                                    <a href="{{route('post.show', $next->slug)}}">
                                        <img src="{{$next->getImage()}}" alt="">

                                        <div class="overlay">
                                            <div class="promo-text">
                                                <p><i class=" pull-right fa fa-angle-right"></i></p>
                                                <h5>{{$next->title}}</h5>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div><!--blog next previous end-->

                    @if(!empty($related))
                        <div class="related-post-carousel"><!--related post carousel-->
                            <div class="related-heading">
                                <h4>You might also like</h4>
                            </div>
                            <div id="also_like_tns">
                                @foreach($related as $item)
                                    <div class="single-item">
                                        <a href="{{route('post.show', $item->slug)}}">
                                            <img src="{{$item->getImage()}}" alt="">
                                            <p>{{$item->title}}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
