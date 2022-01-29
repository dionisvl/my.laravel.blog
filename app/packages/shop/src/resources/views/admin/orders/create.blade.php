@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить заказ
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('orders.store')}}">
            @method('PUT')
            @csrf
            <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавляем заказ</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{old('title')}}">

                                <label for="price">Цена:</label>
                                <input type="number" name="price" id="price" class="form-control"
                                       value="{{old('price', 1990)}}">

                                <label for="phone">Телефон</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{old('phone')}}">

                                <label for="address">Адрес</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{{old('address')}}">

                                <label for="notes">Заметки:</label>
                                <textarea name="notes" id="notes" cols="30" rows="4"
                                          class="form-control">{{old('notes')}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contents">Содержимое:</label>
                                <textarea name="contents" id="contents" cols="30" rows="4"
                                          class="form-control">{{old('contents')}}</textarea>

                                <label for="contents_json">Содержимое JSON:</label>
                                <textarea name="contents_json" id="contents_json" cols="30" rows="4"
                                          class="form-control">
                                {{old('contents_json')}}</textarea>

                                <label for="manager">Менеджер</label>
                                <input type="text" class="form-control" id="manager" name="manager"
                                       value="{{old('manager')}}">

                                <label for="status">Статус заказа:</label>
                                <input type="number" name="status" id="status" class="form-control"
                                       value="{{old('status', 0)}}">
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default">Назад</button>
                        <button class="btn btn-success pull-right">Добавить</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
