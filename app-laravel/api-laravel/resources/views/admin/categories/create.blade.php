@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Добавляем категорию</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                <div class="box-header with-border">
                    <h3 class="box-title">Добавляем категорию</h3>
                    @if($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>

                    @endif
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control" id="title" name='title' placeholder="">

                            <label for="detail_text">Подробное описание</label>
                            <textarea name="detail_text" id="detail_text" cols="30" rows="10"
                                      class="form-control myeditable">{{old('detail_text')}}</textarea>

                            <label for="preview_text">Краткое описание</label>
                            <textarea name="preview_text" id="preview_text" cols="30" rows="10"
                                      class="form-control myeditable">{{old('preview_text')}}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default">Назад</button>
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                </form>
            <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
