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
        {{Form::open([
            'route'	=>	['products.update', $product->id],
            'files'	=>	true,
            'method'	=>	'put'
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем товар</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="title"
                                   value="{{$product->title}}">

                            <label for="price">Цена:</label>
                            <input type="number" name="price" id="price" class="form-control"
                                   value="{{$product->price}}">

                            <img src="{{$product->getImage()}}" alt="" class="img-responsive" width="200">
                            <label for="exampleInputFile">Лицевая картинка</label>
                            <input type="file" id="exampleInputFile" name="image">
                            <p class="help-block"></p>

                            <label>Категория</label>
                            {{Form::select('category_id',
                                $categories,
                              $product->getCategoryID(),
                                ['class' => 'form-control select2'])
                            }}

                            <label>Дата:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" name="date"
                                       value="{{$product->date}}">
                            </div>

                            <label for="balance">Остаток(на складе):</label>
                            <input type="number" name="balance" id="balance" class="form-control"
                                   value="{{$product->balance}}">

                            <label for="size">Объем, размеры:</label>
                            <input type="text" name="size" id="size" class="form-control" value="{{$product->size}}">

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
                            <label for="exampleInputEmail1">Подробное описание в карточке элемента</label>
                            <textarea name="detail_text" id="detail_text" cols="30" rows="10"
                                      class="form-control myeditable">{{$product->detail_text}}</textarea>

                            {{--                            <label for="exampleInputEmail1">Краткое писание</label>--}}
                            {{--                            <textarea name="preview_text" id="preview_text" cols="30" rows="4"--}}
                            {{--                                      class="form-control myeditable">{{$product->preview_text}}</textarea>--}}

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
            {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
