@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить заказ
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open([
            'route'	=>	['orders.update', $order->id],
            'files'	=>	true,
            'method'	=>	'put'
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем заказ</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$order->title}}">

                            <label for="slug">Код</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{$order->slug}}">

                            <label for="price">Цена:</label>
                            <input type="number" name="price" id="price" class="form-control"
                                   value="{{$order->price}}">

                            <label for="phone">Телефон</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{$order->phone}}">

                            <label for="address">Адрес</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{$order->address}}">

                            <label for="notes">Заметки:</label>
                            <textarea name="notes" id="notes" cols="30" rows="4"
                                      class="form-control">{{$order->notes}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contents">Содержимое:</label>
                            <textarea name="contents" id="contents" cols="30" rows="4"
                                      class="form-control">{{$order->contents}}</textarea>

                            <label for="contents_json">Содержимое JSON:</label>
                            <textarea name="contents_json" id="contents_json" cols="30" rows="4" class="form-control">
                                {{$order->contents_json}}</textarea>

                            <label for="manager">Менеджер</label>
                            <input type="text" class="form-control" id="manager" name="manager"
                                   value="{{$order->manager}}">

                            <label for="status">Статус заказа:</label>
                            <input type="number" name="status" id="status" class="form-control"
                                   value="{{$order->status}}">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
