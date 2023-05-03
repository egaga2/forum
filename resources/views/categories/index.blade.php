@extends('layouts.app')

@section('content')

@section('content_header','Categories')
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

            <!-- general form elements -->
                <div class="box data-table-list">
                    <!-- box-body -->
                    <div class="box-body no-padding">
                        <div class="basic-tb-hd clearfix">
                            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">Categories</h2>
                            <div class="btn-group pull-right">
                                <a href="javascript:void(0);" id="addcategory" class="btn btncus btn_blue"><i
                                            class="notika-icon notika-draft"></i> Add New Category</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="col-md-1">#</th>
                                    <th class="col-md-2">Title</th>
                                    <th class="col-md-5">Description</th>
                                    <th class="col-md-3" style="text-align: right">Action</th>

                                </tr>
                                </thead>
                                <tbody id="pages">
                                @foreach($pages as $k=>$row)
                                    <tr id="{{ $row->id }}">
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->description}}</td>
                                        <td style="text-align: right"><a data-id="{{ $row->id }}"
                                                                         data-url="{{action('CategoriesController@getcate')}}"
                                                                         href="javascript:void(0);"
                                                                         class="btn btn-primary btn-sm waves-effect editCat"><i
                                                        class="notika-icon notika-draft"></i>
                                                Edit
                                            </a>
                                            <a href="javascript:void(0);"
                                               data-url="{{action('CategoriesController@destroy', $row->id)}}"
                                               data-id="{{$row->id}}"
                                               class="_delete_data">
                                                <span class="btn btn-danger btn-sm waves-effect "> <i
                                                            class="notika-icon notika-trash"></i> Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="pagination-inbox text-center">
                        {!! $pages->links() !!}
                    </div>
                </div>
                <!-- /.general form elements -->

                @if($pages->isEmpty())
                    <h6 class="alert alert-danger">No record.</h6>
                @endif

            </div>
            <!-- /.col -->

        </div>
    </div>
</div>
<!-- /.box -->
@include('categories.form')
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('blur', '#catname', function () {
                var name = $(this).val();
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: '{{action('CategoriesController@getcate')}}',
                    type: 'POST',
                    data: {
                        "id": name,
                        "type": "slug",
                        "_token": token,
                    },
                    success: function (data) {
                        $("#catpermalink").val(data.slug);
                    }
                });
            });
            $(document).on('click', '.editCat', function () {
                var url = $(this).data("url");
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        "id": id,
                        "type": "all",
                        "_token": token,
                    },
                    success: function (response) {
                        obj = response;
                        $('#exampleModal').modal('show');
                        $("#name").val(obj.name);
                        $("#permalink").val(obj.permalink);
                        $("#description").val(obj.description);
                        $("#id").val(obj.id);
                    }
                });
            });
            $(document).on('click', '#addcategory', function () {
                $('#addcat').modal('show');
            });
            $(document).on('click', '._delete_data', function () {
                var id = $(this).data("id");
                var url = $(this).data("url");
                // var id = $(this).attr('data-id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this Cate!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }).then(isConfirmed => {
                    if (isConfirmed) {
                        $.ajax(
                            {
                                url: url,
                                type: 'DELETE',
                                data: {
                                    "id": id,
                                    "_token": token,
                                },
                                success: function (data) {
                                    if (data.status) {
                                        swal("Deleted!", data.message, "success");
                                        document.getElementById(id).remove();
                                    } else {
                                        swal("Delete!", data.message, "error");
                                    }
                                }
                            });
                    }
                });
            });
            $(document).on('click', '#updateCategory', function (e) {
                var id = $('#id').val();
                var name = $('#name').val();
                var permalink = $('#permalink').val();
                var description = $('#description').val();
                $.ajax({
                    url: '{{action('CategoriesController@addcate')}}',
                    type: "POST",
                    data: {
                        "type": "edit",
                        "id": id,
                        "name": name,
                        "permalink": permalink,
                        "description": description,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        if (data.status) {
                            swal(data.message);
                            setTimeout(function () {
                                $('#exampleModal').modal('hide');
                                window.location.reload(true);
                            }, 100);
                        } else {
                            $('#successAdmin').addClass('hide');
                            $('#errorAdmin').html(data.message);
                            $('#errorAdmin').removeClass('hide');
                        }
                    },
                    error: function (xhr, data, error) {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                });
            });
            $(document).on('click', '#addCategory', function (e) {
                var name = $('#catname').val();
                var permalink = $('#catpermalink').val();
                var description = $('#catdescription').val();
                $.ajax({
                    url: '{{action('CategoriesController@addcate')}}',
                    type: "POST",
                    data: {
                        "type": "add",
                        "name": name,
                        "permalink": permalink,
                        "description": description,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        if (data.status) {
                            $('#successAdminadd').addClass('hide');
                            $('#errorAdminadd').addClass('hide');
                            swal(data.message);
                            setTimeout(function () {
                                $('#addcat').modal('hide');
                                window.location.reload(true);
                            }, 100);

                        } else {
                            $('#successAdminadd').addClass('hide');
                            $('#errorAdminadd').html(data.message);
                            $('#errorAdminadd').removeClass('hide');
                        }
                    },
                    error: function (xhr, data, error) {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                });
            });
        });
    </script>
@endsection
