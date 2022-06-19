@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Заказы</h1>
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
                    <h3 class="box-title">Список всех заказов</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('orders.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="admin_data_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Код</th>
                            <th>Состав</th>
                            <th>Стоимость</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->title}}</td>
                                <td>{{$order->slug}}</td>
                                <td>{{$order->contents}}</td>
                                <td>{{$order->price}}</td>
                                <td>
                                    <a href="{{route('orders.edit', $order->id, false)}}"><i
                                            class="fas fa-pencil-alt"></i></a>

                                    <form method="POST" action="{{route('orders.destroy', $order->id, false)}}">
                                        @method('DELETE')
                                        @csrf
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
                <div class="box-body">
                    <a href="{{route('orders_download')}}"><i class="fas fa-file-excel"></i> Скачать в EXCEL</a>
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
