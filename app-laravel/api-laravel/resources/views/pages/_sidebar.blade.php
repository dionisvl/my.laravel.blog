<div class="w-full md:w-1/4">
    <div class="sticky top-4 space-y-3">

        <!-- Categories Widget -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 p-4">
            <h3 class="text-lg font-semibold text-center mb-4">Categories</h3>
            <ul class="space-y-2">
                @foreach($categories as $category)
                    <li class="border-b border-gray-200 pb-2 last:border-0 last:pb-0">
                        <a href="{{route('blog.category.show', $category->slug, 0)}}"
                           class="text-gray-700 hover:text-blue-500 transition flex justify-between">
                            <span class="text-sm">{{$category->title}}</span>
                            <span class="text-gray-500 text-sm">({{$category->posts_count}})</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Realtime Chat Widget -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 p-4">
            <h3 class="text-lg font-semibold text-center mb-4">Realtime chat</h3>
            <x-package-chat-box/>
        </div>

        <!-- Newsletter Widget -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 p-4">
            <h3 class="text-lg font-semibold text-center mb-4">Get Newsletter</h3>

            <form id="subscribe_form" action="{{route('subscribe.create')}}" method="post">
                {{csrf_field()}}

                <x-inputs.honeypot/>
                <x-inputs.countme/>

                <input type="email" placeholder="Your email address" name="email"
                       onkeyup="count_keyup()"
                       onclick="count_keyup()"
                       class="w-full px-4 py-2 mb-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                <label class="flex items-center mb-4">
                    <input class="mr-2 h-4 w-4" type="checkbox" required checked>
                    <span class="text-sm text-gray-600">
                        I agree to the <a href='/privacy' class="text-blue-500 hover:underline">processing</a> of personal data.
                    </span>
                </label>

                <button type="submit"
                        class="w-full bg-gray-800 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition duration-200 uppercase font-medium"
                        onclick="count_keyup()">
                    Subscribe Now
                </button>
                <input type="hidden" id="recaptchaResponse" name="recaptcha_response">
            </form>

            <script>
              document.getElementById('subscribe_form').addEventListener('submit', function (e) {
                e.preventDefault()
                grecaptcha.execute('6LfXFfgmAAAAAIsCwVgf2a-UBefomwCjJIaJu5l2', { action: 'submit' }).then(function (token) {
                  document.getElementById('recaptchaResponse').value = token
                  e.target.submit()
                })
              })
            </script>
        </div>

        <!-- Featured Posts Widget -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 p-4">
            <h3 class="text-lg font-semibold text-center mb-4">Featured Posts</h3>

            <div class="space-y-4">
                @foreach($featuredPosts->take(4) as $post)
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0 w-20 h-20 relative group">
                            <a href="{{route('post.show', $post->slug, 0)}}" class="block w-full h-full">
                                <img src="{{$post->getImage()}}" alt="" loading="lazy"
                                     class="w-full h-full object-cover rounded">
                                <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity rounded"></div>
                            </a>
                        </div>
                        <div>
                            <a href="{{route('post.show', $post->slug, 0)}}"
                               class="font-medium text-gray-800 hover:text-blue-500 transition text-sm block mb-1">
                                {{$post->title}}
                            </a>
                            <span class="text-xs text-gray-500">{{$post->getDate()}}</span>
                            <div class="text-xs text-gray-500">
                                {!! $post->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Recent Posts Widget -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 p-4">
            <h3 class="text-lg font-semibold text-center mb-4">Recent Posts</h3>
            <div class="space-y-4">
                @foreach($recentPosts as $post)
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0 w-20 h-20 relative group">
                            <a href="{{route('post.show', $post->slug, 0)}}" class="block w-full h-full">
                                <img src="{{$post->getImage()}}" alt="" loading="lazy"
                                     class="w-full h-full object-cover rounded">
                                <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity rounded"></div>
                            </a>
                        </div>
                        <div>
                            <a href="{{route('post.show', $post->slug, 0)}}"
                               class="font-medium text-gray-800 hover:text-blue-500 transition text-sm block mb-1">{{$post->title}}</a>
                            <span class="text-xs text-gray-500">{{$post->getDate()}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
