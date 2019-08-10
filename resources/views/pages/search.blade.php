@extends('layout')

@section('content')
    <form action="/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q"
                   placeholder="Search users">
            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
        </div>
    </form>

    <div class="container">
        @if(isset($details))
            <p> The Search results for your query <b> {{ $query }} </b> are :</p>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>title</th>
                    <th>description</th>
                    <th>content</th>
                </tr>
                </thead>
                <tbody>
                @foreach($details as $post)
                    <tr>
                        <td><a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></td>
                        <td><a href="{{route('post.show', $post->slug)}}">{{$post->description}}</a></td>
                        <td><a href="{{route('post.show', $post->slug)}}">{{$post->content}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection