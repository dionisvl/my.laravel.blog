<div class="col-md-4">
    <div class="primary-sidebar sticky-top">

        <aside class="widget news-letter">
            <h3 class="widget-title text-uppercase text-center">Get Newsletter</h3>
            {{--@include('admin.errors')--}}

            <form action="{{route('subscribe.create')}}" method="post">
                {{csrf_field()}}

                <x-inputs.honeypot/>
                <x-inputs.countme/>

                <input type="email" placeholder="Your email address" name="email"
                       onkeyup="count_keyup()"
                       onclick="count_keyup()">
                <label class="privacy-box"> <input class="form-control" type="checkbox" required="" checked="">
                    <span>
                        Соглашаюсь на <a href="/privacy">обработку</a> персональных данных
                    </span>
                </label>
                <input type="submit" value="Subscribe Now"
                       class="text-uppercase text-center btn btn-subscribe" onclick="count_keyup()">
            </form>
        </aside>

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Online chat</h3>
            <x-package-chat-box/>
        </aside>

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Featured Posts</h3>

            <div id="widget-feature-tns">
                @foreach($featuredPosts as $post)
                    <div class="item">
                        <div class="feature-content">
                            <img src="{{$post->getImage()}}" alt="" loading="lazy">

                            <a href="{{route('post.show', $post->slug)}}" class="overlay-text text-center">
                                <h5 class="text-uppercase">{{$post->title}}</h5>

                                <p>{!!$post->description!!}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="customize-tools">
                <ul class="controls" id="customize-controls">
                    <li class="prev">
                        <i class='fa fa-angle-left'></i>
                    </li>
                    <li class="next">
                        <i class='fa fa-angle-right'></i>
                    </li>
                </ul>
            </div>
        </aside>

        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
            @foreach($recentPosts as $post)
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <a href="{{route('post.show', $post->slug)}}" class="popular-img">
                                <img src="{{$post->getImage()}}" alt="" loading="lazy">
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
                        <a href="{{route('blog.category.show', $category->slug)}}">{{$category->title}}</a>
                        <span class="post-count pull-right"> ({{$category->posts_count}})</span>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</div>
