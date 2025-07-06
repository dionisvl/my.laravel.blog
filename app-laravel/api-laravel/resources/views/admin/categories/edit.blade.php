@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить категорию
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Меняем категорию</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{$category->title}}">

                            <label for="detail_text">Подробное описание</label>
                            <textarea name="detail_text" id="detail_text" cols="30" rows="10"
                                      class="form-control myeditable">{{$category->detail_text}}</textarea>

                            <label for="preview_text">Краткое писание</label>
                            <textarea name="preview_text" id="preview_text" cols="30" rows="4"
                                      class="form-control myeditable">{{$category->preview_text}}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default">Назад</button>
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
                </form>
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
