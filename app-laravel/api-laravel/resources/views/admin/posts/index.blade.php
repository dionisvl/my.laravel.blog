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
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('posts.create', [], false)}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="admin_data_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Теги</th>
                            <th>Картинка</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->getCategoryTitle()}}</td>
                                <td>{{$post->getTagsTitles()}}</td>
                                <td>
                                    <img src="{{$post->getImage()}}" alt="" width="100">
                                </td>
                                <td>
                                    <a href="{{route('posts.edit', $post->id)}}"><i class="fas fa-pencil-alt"></i></a>

                                    <form method="POST" action="{{route('posts.destroy', $post->id, false)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <a target='_blank' href="{{$post->getUrl()}}">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
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
