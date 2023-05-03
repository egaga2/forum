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
                        <li class="breadcrumb-item active" aria-current="page">Site Configurations</li>
                    </ol>
                    <div class="row">
                        <div class="col-lg-3"><p class="text-muted">Site Configurations<br><small class="text-muted">
                                    General settings page.
                                </small></p></div>
                        <!-- form -->
                        <div class="col-lg-9">
                            <!-- form -->
                            <form method="POST" enctype="multipart/form-data" action="{{url('/admin/settings')}}">
                            @csrf @method('POST')

                            <!-- box-body -->
                                <div class="box-body">
                                    @foreach ($settings as $setting)
                                        @php $setting_data[$setting->name]=$setting->value; @endphp
                                    @endforeach
                                    <div class="form-group">
                                        <label>Site Title</label>
                                        <input type="text" name="site_title" class="form-control"
                                               value="{{$setting_data['site_title']}}"
                                               placeholder=""/>
                                    </div>

                                    <div class="form-group">
                                        <label>Site description</label>
                                        <textarea class="form-control" name="site_description"
                                                  rows="3">{{$setting_data['site_description']}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Logo</label>
                                        <img src="{{ asset('public/theme/images/logo.png') }}?r={{Str::random(40)}}"
                                             class="img-responsive image_preview">
                                        <input type="file" name="logo">
                                    </div>
                                    <div class="form-group">
                                        <label>Favicon</label>
                                        <img src="{{ asset('public/theme/images/favicon.png') }}?r={{Str::random(40)}}"
                                             class="img-responsive image_preview">
                                        <input type="file" name="favicon">
                                    </div>
                                        <div class="form-group">
                                            <label>Imgur Client Id</label>
                                            <input type="text" name="imgurClientId" class="form-control"
                                                   value="{{$setting_data['imgurClientId']}}"
                                                   placeholder=""/>
                                        </div>
                                    <div class="form-group">
                                        <label>html code before head</label>
                                        <textarea class="form-control" name="before_head_tag"
                                                  rows="3">{{$setting_data['before_head_tag']}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>html code after body</label>
                                        <textarea class="form-control" name="after_head_tag"
                                                  rows="3">{{$setting_data['after_head_tag']}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>html code before body end</label>
                                        <textarea class="form-control" name="before_body_end_tag"
                                                  rows="3">{{$setting_data['before_body_end_tag']}}</textarea>
                                    </div>
                                        Login Social config
                                        <hr>
                                        <div class="form-group">
                                            <label>Facebook App Id</label>
                                            <input type="text" name="fbAppId" class="form-control"
                                                   value="{{$setting_data['fbAppId']}}"
                                                   placeholder=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Facebook App Secret</label>
                                            <input type="text" name="fbAppSecet" class="form-control"
                                                   value="{{$setting_data['fbAppSecet']}}"
                                                   placeholder=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Google App Id</label>
                                            <input type="text" name="googleAppId" class="form-control"
                                                   value="{{$setting_data['googleAppId']}}"
                                                   placeholder=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Google App Secret</label>
                                            <input type="text" name="googleAppSecret" class="form-control"
                                                   value="{{$setting_data['googleAppSecret']}}"
                                                   placeholder=""/>
                                        </div>
                                    Social Media Page Accounts
                                    <hr>
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" class="form-control"
                                               value="{{$setting_data['facebook']}}"
                                               placeholder=""/>
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="text" name="twitter" class="form-control"
                                               value="{{$setting_data['twitter']}}"
                                               placeholder=""/>
                                    </div>
                                    <div class="form-group">
                                        <label>Google+</label>
                                        <input type="text" name="google" class="form-control"
                                               value="{{$setting_data['google']}}"
                                               placeholder=""/>
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input type="text" name="instagram" class="form-control"
                                               value="{{$setting_data['instagram']}}"
                                               placeholder=""/>
                                    </div>
                                </div>
                                <!-- /.box-body -->

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
