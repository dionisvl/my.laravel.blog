<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="canonical" href="@php echo env('CANONICAL').$_SERVER['REQUEST_URI'] @endphp"/>

    @if(!empty($post))
        <title>{{$post->getTitle()}}</title>
        <meta property="og:title" content="{{$post->getTitle()}}"/>
        <meta property="og:description" content="{{$post->getDescription()}}"/>
        <meta name='description' itemprop='description' content='{{$post->getDescription()}}'/>
        <meta property="og:image" content="{{$post->getImage()}}"/>
        <meta property="og:image:url" content="{{$post->getImage()}}"/>
    @else
        <title>
            @isset($title)
                {{ $title }} |
            @endisset
            {{ config('app.name') }}
        </title>
    @endif

    <meta name="yandex-verification" content="aeb4e0b17d9f0967"/>

    <!-- common css -->
    <link rel="preload" as='style' href="/css/front.css">
    <link rel="preload" as='style' href="/css/some_fix.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/front.css">
    <link rel="stylesheet" href="/css/some_fix.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon.png">
    @isset($cssParts)
        @foreach($cssParts as $cssPart)
            {!! $cssPart !!}
        @endforeach
    @endisset
</head>

<body>

<nav class="navbar main-menu navbar-expand-md navbar-light border-bottom _fixed">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/storage/blog_images/logo.png" alt="Wiki BWP resource" loading="lazy" class="logo-main">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts/">Contacts</a>
                </li>

                @if(Auth::check())
                    @if(Auth::user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="/admin">Admin panel</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="/profile">My profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                @endif

                <li class="nav-item">
                    <form class="form-inline" role="search" method="POST" id="searchform" action="/search">
                        {{ csrf_field() }}
                        <span class="btn btn-default show_toggle_invokers lens-search" data-to-show="#search_block">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                        <input class="form-control form-control-sm" type="text" placeholder="Search..."
                               aria-label="Search" style="margin-bottom:0;" name="q" id="s">
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-info">
                    {{session('status')}}
                </div>
            @endif
            @if(session('dangerStatus'))
                <div class="alert alert-danger">
                    {{session('dangerStatus')}}
                </div>
            @endif
        </div>
    </div>
</div>
@yield('content')

<!--footer start-->
<div id="footer">

</div>

<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <aside class="footer-widget">
                    <div class="about-img"><img src="/storage/blog_images/footer-logo.png" alt="" loading="lazy"></div>
                    <div class="about-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed voluptua. At vero eos et
                        accusam et justo duo dlores et ea rebum magna text ar koto din.
                    </div>
                    <div class="address">
                        <h4 class="text-uppercase">contact Info</h4>
                        <p> б. Черемушкинская 20, Москва</p>
                        <p> Phone: +123 456 78900</p>
                        <p>info@<?=$_SERVER['HTTP_HOST']?></p>
                    </div>
                </aside>
            </div>

            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Testimonials</h3>

                    <!--Indicator-->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                    </ol>

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Очень хороший сайт, прям помог вообще!</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/storage/blog_images/author.png" alt="" loading="lazy">
                                        <div class="author-text">
                                            <h4>Sophia</h4>

                                            <h4>Client, Tech</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- there must be a nex item active -->
                        </div>
                    </div>

                </aside>
            </div>
            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Custom Category Post</h3>
                    <div class="custom-post">
                        <div>
                            <a href="#"><img src="/storage/blog_images/footer-img.png" alt="" loading="lazy"></a>
                        </div>
                        <div>
                            <a href="#" class="text-uppercase">Home is peaceful Place</a>
                            <span class="p-date">February 15, 2019</span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">&copy; @php echo date('Y'); @endphp <a href="#">Wiki Blog, </a> Designed
                        with
                        <i class="fas fa-heart" style="color: red;"></i> by <a href="#">BWP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- js files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="/js/front.js"></script>
<script src="/js/some_fix.js"></script>

<link rel="stylesheet" href="/css/tiny-slider.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"
        integrity="sha256-CApIX5Te4OdXVy1iWP+5+qG/iHa+8apfYOFagdVMRwk=" crossorigin="anonymous"></script>
<script src="/js/sliders.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.19.0/themes/prism.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.19.0/components/prism-core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.19.0/plugins/autoloader/prism-autoloader.min.js"></script>
@isset($jsParts)
    @foreach($jsParts as $jsPart)
        {!! $jsPart !!}
    @endforeach
@endisset

</body>
</html>
