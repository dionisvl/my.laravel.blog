@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список комментариев</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Автор</th>
                            <th>Текст</th>
                            <th>post_id</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->author_name}}</td>
                                <td>{{$comment->text}}</td>
                                <td>
                                    <a href="{{route('post.showById', ['id' => $comment->post_id])}}">{{$comment->post_id}}</a>
                                </td>
                                <td>
                                    @if($comment->status === 1)
                                        <a href="{{ route('admin.comments.toggle', ['id' => $comment->id]) }}">
                                            <i class="fa fa-lock"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.comments.toggle', ['id' => $comment->id]) }}">
                                            <i class="fas fa-lock-open"></i>
                                        </a>
                                    @endif

                                    <form
                                        action="{{ route('admin.comments.destroy', $comment->id, false) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
