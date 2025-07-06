@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить товар
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('products.store', [], false)}}" enctype='multipart/form-data'>
                @csrf
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавляем товар</h3>
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

                                <label for="preview_picture">Картинка - превью</label>
                                <input type="file" id="preview_picture" name="preview_picture">

                                <label for="detail_picture">Картинка - детальная</label>
                                <input type="file" id="detail_picture" name="detail_picture">

                                <p class="help-block"></p>

                                <label>Категория</label>
                                <select name="category_id" class="form-control select2">
                                    @foreach($categories as $id => $title)
                                        <option value="{{ $id }}">{{ $title }}</option>
                                    @endforeach
                                </select>

                                <label>Дата:</label>
                                <input type="date" class="form-control" name="date" value="<?= date('Y-m-d')?>">

                                <label for="balance">Остаток(на складе):</label>
                                <input type="number" name="balance" id="balance" class="form-control"
                                       value="{{old('balance', 1006)}}">

                                <label for="size">Объем, размеры:</label>
                                <input type="text" name="size" id="size" class="form-control"
                                       value="{{old('size', 'Упаковка 100штук')}}">

                                <label for="manufacturer">Информация о производителе:</label>
                                <input type="text" name="manufacturer" id="manufacturer" class="form-control"
                                       value="{{old('manufacturer')}}">

                                <label for="stars">Оценка (звёзды):</label>
                                <input type="number" name="stars" id="stars" class="form-control"
                                       value="{{old('stars', 100)}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="detail_text">Подробное описание в карточке элемента</label>
                                <textarea name="detail_text" id="detail_text" cols="30" rows="10"
                                          class="form-control myeditable">{{old('detail_text')}}</textarea>

                                <label for="features">Преимущества, особенности товара:</label>
                                <textarea name="features" id="features" cols="30" rows="4"
                                          class="form-control myeditable">{{old('features')}}</textarea>

                                <label for="delivery">Доставка, информация о доставке:</label>
                                <textarea name="delivery" id="delivery" cols="30" rows="4"
                                          class="form-control myeditable">{{old('delivery')}}</textarea>

                                <label for="composition">Состав продукта:</label>
                                <textarea name="composition" id="composition" cols="30" rows="4"
                                          class="form-control ">{{old('composition')}}</textarea>
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
