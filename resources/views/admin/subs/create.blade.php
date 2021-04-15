@extends('admin.layout')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить подписчика
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <form action="{{ route('subscribers.store') }}" method="POST">
      @csrf

      <!-- Default box -->
        <div class="box">

          <div class="box-header with-border">
            <h3 class="box-title">Добавляем подписчика</h3>
            @include('admin.errors')
          </div>

          <div class="box-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="email"
                       value="{{old('email')}}">
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button class="btn btn-success pull-right">Добавить</button>
          </div>

        </div>
      <!-- /.box -->

      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection