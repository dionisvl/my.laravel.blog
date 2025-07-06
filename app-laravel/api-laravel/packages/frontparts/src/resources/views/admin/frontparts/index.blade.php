@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Компоненты</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список всех компонентов</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('frontparts.create', [], false)}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="admin_data_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Код</th>
                            <th>Статус</th>
                            <th>Категория</th>
                            <th>Тип</th>
                            <th>Описание</th>
                            <th>Содержимое</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($frontparts as $frontpart)
                            <tr>
                                <td>{{$frontpart->id}}</td>
                                <td>{{$frontpart->title}}</td>
                                <td>{{$frontpart->slug}}</td>
                                <td>{{$frontpart->status}}</td>
                                <td>{{$frontpart->category_name}}</td>
                                <td>{{$frontpart->type}}</td>
                                <td>{{$frontpart->preview_text}}</td>
                                <td>{{$frontpart->detail_text}}</td>
                                <td>
                                    <a href="{{route('frontparts.edit', $frontpart->id, false)}}"><i
                                            class="fas fa-pencil-alt"></i></a>

                                    <form action="{{ route('frontparts.destroy', $frontpart->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                    <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
