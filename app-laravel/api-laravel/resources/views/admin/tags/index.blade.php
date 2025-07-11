@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('tags.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
                </thead>
                  <tbody>
                  @foreach($tags as $tag)
                      <tr>
                          <td>{{$tag->id}}</td>
                          <td>{{$tag->title}}</td>
                          <td><a href="{{route('tags.edit', $tag->id)}}"><i class="fas fa-pencil-alt"></i></a>
                              <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"
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

                </tfoot>
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
