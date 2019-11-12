<h3>Новые статьи на сайте <a href="http://{{$site}}">{{$site}}</a>:</h3>


<ul>
@foreach ($newPosts as $post)
    <li>
        <a href="{{$post->url}}">{{$post->name}}</a><br>
        <a href="{{$post->url}}"><img src="{{$post->img}}"></a>
    </li>
@endforeach
</ul>
