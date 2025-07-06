@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить статью
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('posts.store', [], false)}}"
                  accept-charset="UTF-8"
                  enctype="multipart/form-data">
                @method('POST')
                @csrf

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавляем статью</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Название</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                       name="title"
                                       value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Лицевая картинка</label>
                                <input type="file" id="exampleInputFile" name="image">

                                <p class="help-block">Какое-нибудь уведомление о форматах..</p>
                            </div>
                            <div class="form-group">
                                <label>Категория</label>
                                <select name="category_id" class="form-control select2">
                                    <option value="">Выберите категорию</option>
                                    @foreach($categories as $id => $title)
                                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Теги</label>
                                <select name="tags[]" class="form-control select2" multiple="multiple"
                                        data-placeholder="Выберите теги">
                                    @foreach($tags as $id => $title)
                                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Date -->
                            <div class="form-group">
                                <label>Дата:</label>
                                <input type="date" class="form-control" name="date" value="<?=date('Y-m-d')?>">
                            </div>

                            <!-- checkbox -->
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="minimal" name="is_featured">
                                </label>
                                <label>
                                    Рекомендовать
                                </label>
                            </div>

                            <!-- checkbox -->
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="minimal" name="status">
                                </label>
                                <label>
                                    Черновик
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Полный текст</label>
                                <textarea name="content" id="content" cols="30" rows="10"
                                          class="form-control myeditable"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Описание</label>
                                <textarea name="description" id="" cols="30" rows="10"
                                          class="form-control myeditable">{{old('description')}}</textarea>
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
