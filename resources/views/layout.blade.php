<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="/css/front.css">
    <link rel="stylesheet" href="/css/some_fix.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">


    <!-- Initialize EnlighterJS -->
    <link rel="stylesheet" type="text/css" href="/js/enlighterjs/EnlighterJS.min.css"/>
    <script type="text/javascript" src="/js/enlighterjs/MooTools.min.js"></script>
    <script type="text/javascript" src="/js/enlighterjs/EnlighterJS.min.js"></script>
    <meta name="EnlighterJS" content="Advanced javascript based syntax highlighting" data-indent="4"
          data-selector-block="pre" data-selector-inline="code" data-language="js"/>
    <!-- Initialize EnlighterJS END -->
    <? require($_SERVER['DOCUMENT_ROOT'] . '/tracking.php')?>
</head>

<body>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="BWP wiki resource" loading="lazy"></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    <li><a href="/">Homepage</a></li>
                    <li><a href="/contacts/">Contacts</a></li>
                </ul>

                <ul class="nav navbar-nav text-uppercase pull-right">
                    @if(Auth::check())
                        @if(Auth::user()->is_admin)
                            <li><a href="/admin">Admin panel</a></li>
                        @endif
                        <li><a href="/profile">My profile</a></li>
                        <li><a href="/logout">Logout</a></li>
                    @else
                        <li><a href="/register">Register</a></li>
                        <li><a href="/login">Login</a></li>
                    @endif
                    <li>
                        <button class="btn btn-default show_toggle_invokers" data-to-show="#search_block">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </li>

                </ul>

            </div>
            <!-- /.navbar-collapse -->


            <div class="show-search" id="search_block">
                <form role="search" method="POST" id="searchform" action="/search">
                    {{ csrf_field() }}
                    <div>
                        <input type="text" placeholder="Search and hit enter..." name="q" id="s">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
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

    <?/*<div class="footer-instagram-section">
        <h3 class="footer-instagram-title text-center text-uppercase">Instagram</h3>
        <div id="footer-instagram" class="owl-carousel">
            <div class="item">
                <a href="#"><img src="/images/ins-1.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-2.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-3.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-4.jpg" alt=""></a>
            </div>
        </div>
    </div>*/?>

</div>

<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <aside class="footer-widget">
                    <div class="about-img"><img src="/images/footer-logo.png" alt="" loading="lazy"></div>
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

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!--Indicator-->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                                            tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                                            vero eos et accusam justo duo dolores et ea rebum.gubergren no sea takimata
                                            magna aliquyam eratma</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/images/author.png" alt="" loading="lazy">
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
                            <a href="#"><img src="/images/footer-img.png" alt="" loading="lazy"></a>
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
                    <div class="text-center">&copy; 2019 <a href="#">Wiki Blog, </a> Designed with <i
                            class="fa fa-heart"></i> by <a href="#">BWP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- js files -->
<script src="/js/front.js"></script>
<script src="/js/some_fix.js"></script>
</body>
</html>
