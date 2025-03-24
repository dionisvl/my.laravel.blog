<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">

    @if(!empty(env('CANONICAL')))
        <link rel="canonical" href="@php echo env('CANONICAL').$_SERVER['REQUEST_URI'] @endphp"/>
    @endif

    @if(!empty($post))
        <title>{{$post->getTitle()}}</title>
        <meta property="og:title" content="{{$post->getTitle()}}"/>
        @if(!empty($post->description))
            <meta property="og:description" content="{{$post->getDescription()}}"/>
            <meta name='description' itemprop='description' content='{{$post->getDescription()}}'/>
        @endif
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

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"
          integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- common css -->
    <link rel="stylesheet" href="{{ mix('/css/front.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon.png">

    @isset($cssParts)
        @foreach($cssParts as $cssPart)
            {!! $cssPart !!}
        @endforeach
    @endisset
</head>

<body class="bg-gray-100">
<!-- Navigation -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-2 relative flex items-center justify-between">
        <!-- Логотип -->
        <a class="flex-shrink-0" href="/">
            <img src="/storage/blog_images/logo.png" alt="Wiki BWP resource" loading="lazy" class="h-10">
        </a>

        <!-- Кнопка-бургер (видна только на мобильном) -->
        <button class="md:hidden px-2 py-1 border border-gray-300 rounded"
                type="button" onclick="toggleMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div id="navbarMenu"
             class="hidden md:flex flex-col sm:flex-row items-start sm:items-center
            space-y-2 sm:space-y-0 sm:space-x-4
            absolute sm:static top-full left-0 right-0 bg-white sm:bg-transparent
            p-4 sm:p-0 shadow sm:shadow-none">

            <a class="text-gray-700 hover:text-blue-500 font-medium" href="/">Homepage</a>
            <a class="text-gray-700 hover:text-blue-500 font-medium" href="/contacts/">Contacts</a>

            @if(Auth::check())
                @if(Auth::user()->is_admin)
                    <a class="text-gray-700 hover:text-blue-500 font-medium" href="/admin">Admin panel</a>
                @endif
                <a class="text-gray-700 hover:text-blue-500 font-medium" href="/profile">My profile</a>
                <a class="text-gray-700 hover:text-blue-500 font-medium" href="/logout">Logout</a>
            @else
                <a class="text-gray-700 hover:text-blue-500 font-medium" href="/register">Register</a>
                <a class="text-gray-700 hover:text-blue-500 font-medium" href="/login">Login</a>
            @endif

            <form class="relative w-full md:w-auto" role="search" method="POST" action="/search">
                {{ csrf_field() }}
                <input class="pl-8 pr-4 py-1 border border-gray-300 rounded-full text-sm
                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       type="text" placeholder="Search..." name="q">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4 absolute left-2.5 top-2 text-gray-400"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </form>
        </div>
    </div>

    <script>
      function toggleMenu () {
        document.getElementById('navbarMenu').classList.toggle('hidden')
      }
    </script>
</nav>


<!-- Status Messages -->
<div class="container mx-auto px-4 pt-4">
    @if(session('status'))
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
            {{session('status')}}
        </div>
    @endif
    @if(session('dangerStatus'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{session('dangerStatus')}}
        </div>
    @endif
</div>

<!-- Main Content -->
<div class="bg-gray-100 mt-6">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex flex-wrap">
            @yield('content')
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white pt-12 mt-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <div class="mb-4">
                    <img src="/storage/blog_images/footer-logo.png" alt="" loading="lazy" class="h-12">
                </div>
                <p class="text-gray-300 mb-4">
                    Stay updated with the latest trends in Web3 development, software engineering tips, and best coding
                    practices for modern applications.
                </p>
                <div>
                    <h4 class="text-lg font-semibold uppercase mb-2">Contact Info</h4>
                    <p class="text-gray-300 mb-1">10 Rustaveli Avenue, Tbilisi, Georgia</p>
                    <p class="text-gray-300 mb-1">Phone: +123 456 78900</p>
                    <p class="text-gray-300">info@<?= $_SERVER['HTTP_HOST'] ?></p>
                </div>
            </div>

            <!-- Testimonials -->
            <div>
                <h3 class="text-lg font-semibold uppercase mb-4">Testimonials</h3>
                <div id="myCarousel" class="relative">
                    <div class="bg-gray-700 p-4 rounded">
                        <div class="text-gray-300 italic mb-4">
                            <p>A very good website, it really helped a lot!</p>
                        </div>
                        <div class="flex items-center">
                            <img src="/storage/blog_images/author.png" alt="" loading="lazy"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <h4 class="font-semibold">Sophia</h4>
                                <p class="text-sm text-gray-400">Client, Tech</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Post Section -->
            <div>
                <h3 class="text-lg font-semibold uppercase mb-4">Custom Category Post</h3>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        <a href="#"><img src="/storage/blog_images/footer-img.png" alt="" loading="lazy"
                                         class="w-20 h-20 object-cover rounded"></a>
                    </div>
                    <div>
                        <a href="#" class="text-white hover:text-blue-300 font-medium">Home is peaceful Place</a>
                        <p class="text-sm text-gray-400 mt-1">February 15, 2019</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="py-4 mt-8 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center text-gray-400">
                &copy; 2019-@php echo date('Y'); @endphp <a href="#" class="hover:text-white">Web3 blog, </a> Designed
                with
                <i class="fas fa-heart text-red-500"></i> and <a href="#" class="hover:text-white">Laravel 10</a>
            </div>
        </div>
    </div>

    @isset($jsParts)
        @foreach($jsParts as $jsPart)
            {!! $jsPart !!}
        @endforeach
    @endisset
</footer>

<!-- JavaScript -->
<script src="/js/front.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.30.0/components/prism-core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.30.0/plugins/autoloader/prism-autoloader.min.js"></script>

</body>
</html>
