@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить товар
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('products.update', $product->id, false)}}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Обновляем товар</h3>
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{$product->title}}">

                                <label for="slug">Код</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       value="{{$product->slug}}">

                                <label for="price">Цена:</label>
                                <input type="number" name="price" id="price" class="form-control"
                                       value="{{$product->price}}">

                                <img src="{{$product->getImage('preview_picture')}}" alt="" class="img-responsive"
                                     width="200">
                                <label for="preview_picture">Картинка - превью</label>
                                <input type="file" id="preview_picture" name="preview_picture">
                                <p class="help-block"></p>

                                <img src="{{$product->getImage('detail_picture')}}" alt="" class="img-responsive"
                                     width="200">
                                <label for="detail_picture">Картинка - детальная</label>
                                <input type="file" id="detail_picture" name="detail_picture">

                                <label>Категория</label>
                                <select name="category_id" class="form-control select2">
                                    @foreach($categories as $id => $title)
                                        <option value="{{ $id }}" {{ $product->getCategoryID() == $id ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>

                                <label>Дата:</label>
                                <input type="date" class="form-control" name="date" value="{{$product->date}}">

                                <label for="balance">Остаток(на складе):</label>
                                <input type="number" name="balance" id="balance" class="form-control"
                                       value="{{$product->balance}}">

                                <label for="size">Объем, размеры:</label>
                                <input type="text" name="size" id="size" class="form-control"
                                       value="{{$product->size}}">

                                <label for="manufacturer">Производитель:</label>
                                <input type="text" name="manufacturer" id="manufacturer" class="form-control"
                                       value="{{$product->manufacturer}}">

                                <label for="stars">Оценка (звёзды):</label>
                                <input type="number" name="stars" id="stars" class="form-control"
                                       value="{{$product->stars}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="detail_text">Подробное описание в карточке элемента</label>
                                <textarea name="detail_text" id="detail_text" cols="30" rows="10"
                                          class="form-control myeditable">{{$product->detail_text}}</textarea>

                                <label for="features">Преимущества, особенности товара:</label>
                                <textarea name="features" id="features" cols="30" rows="4"
                                          class="form-control myeditable">{{$product->features}}</textarea>

                                <label for="delivery">Доставка, информация о доставке:</label>
                                <textarea name="delivery" id="delivery" cols="30" rows="4"
                                          class="form-control myeditable">{{$product->delivery}}</textarea>

                                <label for="composition">Состав продукта:</label>
                                <textarea name="composition" id="composition" cols="30" rows="4"
                                          class="form-control">{{$product->composition}}</textarea>
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
