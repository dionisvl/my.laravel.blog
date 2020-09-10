@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Добавить компонент</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('frontparts.store')}}">
            @csrf
            <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавляем компонент</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{old('title')}}">
                                <label for="slug">Код</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}">

                                <label for="category_name">Категория</label>
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                       value="{{old('category_name')}}">
                                <label for="type">Тип (JS\CSS)</label>
                                <input type="text" class="form-control" id="type" name="type" value="{{old('type')}}">

                                <label for="preview_text">Краткое описание:</label>
                                <textarea name="preview_text" id="preview_text" cols="30" rows="4"
                                          class="form-control">{{old('preview_text')}}</textarea>
                                <label for="detail_text">Содержимое:</label>
                                <textarea name="detail_text" id="detail_text" cols="30" rows="4"
                                          class="form-control">{{old('detail_text')}}</textarea>
                                <label for="status">Статус</label>
                                <input type="text" class="form-control" id="status" name="status"
                                       value="{{old('status', 1)}}">
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
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
