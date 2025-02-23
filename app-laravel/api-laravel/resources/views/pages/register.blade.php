@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 flow-main">
                    <div class="leave-comment mr0">
                        <h3 class="text-uppercase">Register</h3>
                        @include('admin.errors')
                        <br>
                        <form class="form-horizontal contact-form" role="form" method="post" action="/register">
                            {{csrf_field()}}
                            <x-inputs.honeypot/>
                            <x-inputs.countme/>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control border" id="name" name="name"
                                           placeholder="Name" value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" value="{{old('email')}}" class="form-control border" id="email"
                                           name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control border" id="password" name="password"
                                           placeholder="password" onkeyup="count_keyup()">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Register</button>
                        </form>
                    </div>
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
