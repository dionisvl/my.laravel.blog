@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Входящие сообщения
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>message</th>
                            <th>Дата</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomings as $incoming)
                            <tr>
                                <td>{{$incoming->id}}</td>
                                <td>{{$incoming->name}}</td>
                                <td>{{$incoming->email}}</td>
                                <td>{{$incoming->phone}}</td>
                                <td>{{$incoming->message}}</td>
                                <td>{{$incoming->created_at}}</td>
                                <td>
                                    @if($incoming->status == 1)
                                        <a href="/admin/incomings/toggle/{{$incoming->id}}" class="fa fa-lock"></a>
                                    @else
                                        <a href="/admin/incomings/toggle/{{$incoming->id}}" class="fa fa-thumbs-o-up"></a>
                                    @endif
                                    {{Form::open(['route'=>['incomings.destroy', $incoming->id], 'method'=>'delete'])}}
                                    <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                {{Form::close()}}
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
