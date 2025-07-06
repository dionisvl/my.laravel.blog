@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить статью
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем статью</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                   value="{{$post->title}}" name="title">
                        </div>

                        <div class="form-group">
                            <img src="{{$post->getImage()}}" alt="" class="img-responsive" width="200">
                            <label for="exampleInputFile">Лицевая картинка</label>
                            <input type="file" id="exampleInputFile" name="image">

                            <p class="help-block">Какое-нибудь уведомление о форматах..</p>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            <select name="category_id" class="form-control select2">
                                @foreach($categories as $id => $title)
                                    <option value="{{ $id }}" {{ $post->getCategoryID() == $id ? 'selected' : '' }}>{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            <select name="tags[]" class="form-control select2" multiple="multiple"
                                    data-placeholder="Выберите теги">
                                @foreach($tags as $id => $title)
                                    <option value="{{ $id }}" {{ in_array($id, $selectedTags) ? 'selected' : '' }}>{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Дата:</label>
                            <input type="date" class="form-control" name="date" value="{{$post->date}}">
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input name="is_featured" type="checkbox" @if($post->is_featured) checked @endif>
                            </label>
                            <label>
                                Рекомендовать
                            </label>
                        </div>
                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input name="status" type="checkbox" @if($post->status) checked @endif>
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
                                      class="form-control myeditable">{{$post->content}}</textarea>
                        </div>
                    </div>
                    <button class="btn btn-warning pull-right">Изменить</button>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание</label>
                            <textarea name="description" id="" cols="30" rows="10"
                                      class="form-control myeditable">{{$post->description}}</textarea>
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
