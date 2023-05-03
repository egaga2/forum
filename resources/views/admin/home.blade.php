@extends('layouts.app')

@section('content')

@section('content_header', 'Site Configurations')

<div class="contact-area">
    <div class="container">
        <!-- box -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <div class="box normal-table-list">
                    <ol class="breadcrumb breadcrumb-alt push">
                        <li class="breadcrumb-item">
                            <a href="{{action('AdminController@index')}}"><i class="notika-icon notika-house"></i>
                                Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Home Content</li>
                    </ol>
                    <div class="row">
                        <div class="col-lg-3"><p class="text-muted">Home Content<br><small class="text-muted">
                                    Update Home Text
                                </small></p></div>
                        <!-- form -->
                        <div class="col-lg-9">
                            <!-- form -->
                            <form method="POST" enctype="multipart/form-data" action="{{url('/admin/homeUpdate')}}">
                            @csrf @method('POST')
                            <!-- box-body -->
                                <div class="box-body">
                                    @foreach ($settings as $r)
                                        <div class="form-group">
                                            <label>{{$r->name}}</label>
                                            <input type="text" name="{{$r->code}}" class="form-control"
                                                   value="{{$r->value}}"
                                                   placeholder=""/>
                                        </div>
                                    @endforeach
                                <div class="box-footer">
                                    <button type="submit" class="btn btncus btn_blue">Save Setting</button>
                                </div>

                            </form>
                            <!-- /.form -->
                            <!-- general form elements -->
                        </div>
                    </div>
                </div>
                <!-- /.col -->

            </div>
        </div>
    </div>
    <!-- /.box -->

@endsection
