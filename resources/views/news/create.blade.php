@extends('layouts.app')

@section('content')

@section('content_header','Create News')
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
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
            @endif

            <!-- general form elements -->
                <div class="box box-primary normal-table-list">
                    <ol class="breadcrumb breadcrumb-alt push">
                        <li class="breadcrumb-item">
                            <a href="{{action('NewsController@index')}}"><i class="notika-icon notika-windows"></i>
                                New</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create new</li>
                    </ol>
                    <div class="row">
                        <div class="col-lg-3"><p class="text-muted">News Information</p></div>
                        <!-- form -->
                        <div class="col-lg-9">
                            <form method="POST" enctype="multipart/form-data" action="{{url('/admin/news')}}">
                            @csrf @method('POST')

                            <!-- box-body -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Title"/>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('admin.short_description') <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description"
                                                  placeholder="@lang('admin.short_description')"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('admin.article') <span class="text-danger">*</span></label>
                                        <textarea class="form-control html-editor-cm" name="details"
                                                  placeholder="@lang('admin.article')"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('admin.image') <span class="text-danger">*</span></label>
                                        <input type="file" name="image">
                                    </div>
                                    Seo Setup
                                    <hr>
                                    <div class="form-group">
                                        <label>Title for seo</label>
                                        <input type="text" name="title_seo" class="form-control" placeholder="Title for seo"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Description for seo</label>
                                        <textarea class="form-control" name="description_seo"
                                                  placeholder="Description for seo"></textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btncus btn_blue">Create New</button>
                                </div>

                            </form>
                            <!-- /.form -->
                        </div>
                    </div>
                </div>
                <!-- /.general form elements -->

            </div>
            <!-- /.col -->

        </div>
    </div>
</div>
<!-- /.box -->
@endsection