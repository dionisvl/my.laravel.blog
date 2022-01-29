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
                        <a href="{{route('portfolios.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="admin_data_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Картинка</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($portfolios as $portfolio)
                            <tr>
                                <td>{{$portfolio->id}}</td>
                                <td>{{$portfolio->title}}</td>
                                <td>
                                    <img src="{{$portfolio->getImage()}}" alt="" width="100">
                                </td>
                                <td>
                                    <a href="{{route('portfolios.edit', $portfolio->id)}}"><i
                                            class="fas fa-pencil-alt"></i></a>

                                    {{Form::open(['route'=>['portfolios.destroy', $portfolio->id], 'method'=>'delete'])}}
                                    <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    {{Form::close()}}

                                    <a href="{{$portfolio->getUrl()}}" target="_blank"> <i
                                            class="fas fa-external-link-alt"></i></a>
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
