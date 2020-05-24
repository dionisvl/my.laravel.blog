@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <article class="post">
                        @if(!empty($post->getImage()))
                            <div class="post-detail-thumb">
                                <img src="{{$post->getImage()}}" alt="">
                            </div>
                        @endif
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                @if($post->hasCategory())
                                    <h6>
                                        <a href="{{route('category.show', $post->category->slug)}}"> {{$post->getCategoryTitle()}}</a>
                                    </h6>
                                @endif
                                <h1 class="entry-title">{{$post->title}}</h1>


                            </header>
                            <div class="entry-content">
                                {!! $post->content !!}
                            </div>
                            <div class="decoration">
                                @foreach($post->tags as $tag)
                                    <a href="{{route('tag.show', $tag->slug)}}"
                                       class="btn btn-default">{{$tag->title}}</a>
                                @endforeach
                            </div>
                            <div class="social-share">
                                <span class="social-share-title pull-left">
                                    By <a href="#">{{$post->author->name}}</a> On <b>{{$post->getDate()}}</b>
                                </span>

                                <span class="float-right">
                                    <span class="pl-2"><i
                                            class="fas fa-eye"></i> {{$post->getViewsCount()}}{{$post->updateViewsCount()}}</span>
                                    <span class="pl-2 likes"><i class="far fa-heart" style="color: red;"></i> {{$post->likes_count}}</span>
                                </span>

                                <ul class="text-center float-right">
                                    <script src="//yastatic.net/share2/share.js"></script>
                                    <div class="ya-share2"
                                         data-services="vkontakte,facebook,twitter,linkedin,telegram"></div>
                                </ul>
                            </div>
                        </div>
                    </article>
                    <div class="top-comment"><!--top comment-->
                        <img src="/storage/blog_images/comment.jpg" class="pull-left img-circle" alt="">
                        <h4>{{$post->author->name}}</h4>

                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                            invidunt ut labore et dolore magna aliquyam erat.</p>
                    </div><!--top comment end-->
                    <div class="row"><!--blog next previous-->
                        <div class="col-md-6">
                            @if($post->hasPrevious())
                                <div class="single-blog-box">
                                    <a href="{{route('post.show', $post->getPrevious()->slug)}}">
                                        <img src="{{$post->getPrevious()->getImage()}}" alt="">
                                        <div class="overlay">
                                            <div class="promo-text">
                                                <p><i class=" pull-left fa fa-angle-left"></i></p>
                                                <h5>{{$post->getPrevious()->title}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($post->hasNext())
                                <div class="single-blog-box">
                                    <a href="{{route('post.show', $post->getNext()->slug)}}">
                                        <img src="{{$post->getNext()->getImage()}}" alt="">

                                        <div class="overlay">
                                            <div class="promo-text">
                                                <p><i class=" pull-right fa fa-angle-right"></i></p>
                                                <h5>{{$post->getNext()->title}}</h5>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div><!--blog next previous end-->
                    @if(!$post->related()->isEmpty())
                        <div class="related-post-carousel"><!--related post carousel-->
                            <div class="related-heading">
                                <h4>You might also like</h4>
                            </div>
                            <!--related post carousel-->
                            <div id="also_like_tns">
                                @foreach($post->related() as $item)
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
                    {{--@if(!$post->comments->isEmpty())--}}
                    @foreach($post->getComments() as $comment)

                        <div class="bottom-comment"><!--bottom comment-->
                            <div class="comment-img">
                                <img class="img-circle" src="{{$comment->getAuthorImage()}}" alt="" width="75"
                                     height="75">
                            </div>

                            <div class="comment-text">
                                <h5>{{$comment->author_name}}</h5>

                                <p class="comment-date">
                                    {{$comment->created_at->diffForHumans()}}
                                </p>

                                <p class="para">{{$comment->text}}</p>
                            </div>
                        </div>
                    @endforeach
                    {{--@endif--}}

                <!-- end bottom comment-->

                    {{--@if(Auth::check())--}}
                    <div class="leave-comment"><!--leave comment-->
                        <h4>Leave a reply</h4>


                        <form class="form-horizontal contact-form" role="form" method="post" action="/comment">
                            {{csrf_field()}}
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="6" name="message"
                                              placeholder="Write Massage"></textarea>
                                </div>
                            </div>
                            <button class="btn send-btn">Post Comment</button>
                        </form>
                    </div><!--end leave comment-->
                    {{--@endif--}}

                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
