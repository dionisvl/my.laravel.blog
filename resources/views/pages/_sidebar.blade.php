<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">



        <aside class="widget news-letter">
            <h3 class="widget-title text-uppercase text-center">Get Newsletter</h3>
            {{--@include('admin.errors')--}}

            <form action="/subscribe" method="post">
                {{csrf_field()}}
                <input type="email" placeholder="Your email address" name="email">
                <label class="privacy-box"> <input class="form-control" type="checkbox" required="" checked="">
                    <p>
                        Соглашаюсь на <a href="/privacy">обработку</a> персональных данных
                    </p>
                </label>
                <input type="submit" value="Subscribe Now"
                       class="text-uppercase text-center btn btn-subscribe">
            </form>
        </aside>

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Featured Posts</h3>

            <div id="widget-feature" class="owl-carousel">
                @foreach($featuredPosts as $post)
                    <div class="item">
                        <div class="feature-content">
                            <img src="{{$post->getImage()}}" alt="">

                            <a href="{{route('post.show', $post->slug)}}" class="overlay-text text-center">
                                <h5 class="text-uppercase">{{$post->title}}</h5>

                                <p>{!!$post->description!!}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </aside>

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
            @foreach($popularPosts as $post)
                <div class="popular-post">


                    <a href="{{route('post.show', $post->slug)}}" class="popular-img">
                        <img src="{{$post->getImage()}}" alt="">

                        <div class="p-overlay"></div>
                    </a>

                    <div class="p-content">
                        <a href="{{route('post.show', $post->slug)}}" class="text-uppercase">{{$post->title}}</a>
                        <span class="p-date">{{$post->getDate()}}</span>

                    </div>
                </div>

            @endforeach
        </aside>

        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
            @foreach($recentPosts as $post)
                <div class="thumb-latest-posts">


                    <div class="media">
                        <div class="media-left">
                            <a href="{{route('post.show', $post->slug)}}" class="popular-img"><img
                                        src="{{$post->getImage()}}" alt="">
                                <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <a href="{{route('post.show', $post->slug)}}" class="text-uppercase">{{$post->title}}</a>
                            <span class="p-date">{{$post->getDate()}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                @foreach($categories as $category)
                    <li>
                        <a href="{{route('category.show', $category->slug)}}">{{$category->title}}</a>
                        <span class="post-count pull-right"> ({{$category->posts()->count()}})</span>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</div>
