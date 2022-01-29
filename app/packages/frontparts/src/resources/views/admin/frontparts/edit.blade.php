@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить компонент
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('frontparts.update', $frontpart->id)}}">
            @method('PUT')
            @csrf
            <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Изменяем компонент</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{$frontpart->title}}">
                                <label for="slug">Код</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       value="{{$frontpart->slug}}">

                                <label for="category_name">Категория</label>
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                       value="{{$frontpart->category_name}}">
                                <label for="type">Тип (JS\CSS)</label>
                                <input type="text" class="form-control" id="type" name="type"
                                       value="{{$frontpart->type}}">

                                <label for="preview_text">Краткое описание:</label>
                                <textarea name="preview_text" id="preview_text" cols="30" rows="4"
                                          class="form-control">{{$frontpart->preview_text}}</textarea>
                                <label for="detail_text">Содержимое:</label>
                                <textarea name="detail_text" id="detail_text" cols="30" rows="4"
                                          class="form-control">{{$frontpart->detail_text}}</textarea>
                                <div class="form-group">
                                    <input type="checkbox" id="status" name="status"
                                           @if($frontpart->status) checked @endif>
                                    <label for="status">Статус</label>
                                </div>
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
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
