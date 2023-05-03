@extends('layouts.app')
@section('content')
@section('content_header','Pages')
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
                            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">News</h2>
                            <div class="btn-group pull-right">
                                <a href="{{action('NewsController@create')}}" class="btn btncus btn_blue"><i
                                            class="notika-icon notika-draft"></i> Add News</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="col-md-2">Title</th>
                                    <th class="col-md-2">Image</th>
                                    <th class="col-md-4">Short Description</th>
                                    <th class="col-md-3" style="text-align: right">Action</th>

                                </tr>
                                </thead>
                                <tbody class="sortable-posts" id="pages">
                                @foreach($news as $k=>$row)
                                    <tr id="{{$row->id}}">
                                        <td>{{$row->title}}</td>
                                        <td><img style="max-height: 50px;" src="{{ asset('public/uploads/news').'/'.$row->image }}"></td>
                                        <td>{{$row->description}}</td>
                                        <td class="text-right"><a
                                                    href="{{action('NewsController@edit', $row->id)}}"
                                                    class="btn btncus btn_blue"><i class="notika-icon notika-draft"></i>
                                                Edit
                                            </a>
                                            <a href="javascript:void(0);"
                                               data-url="{{action('NewsController@destroy', $row->id)}}"
                                               data-id="{{$row->id}}"
                                               class="_delete_data">
                                                <span class="btn btncus notika-btn-black"> <i
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

                </div>
                <!-- /.general form elements -->

                @if($news->isEmpty())
                    <h6 class="alert alert-danger">No record.</h6>
                @endif

            </div>
            <!-- /.col -->

        </div>
    </div>
</div>
<!-- /.box -->

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '._delete_data', function () {
                var id = $(this).data("id");
                var url = $(this).data("url");
                // var id = $(this).attr('data-id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this page!",
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
                                    if(data.status) {
                                        swal("Deleted!", data.message, "success");
                                        document.getElementById(id).remove();
                                    }else{
                                        swal("Delete!", data.message, "error");
                                    }
                                }
                            });
                    }
                });
            });


        });
    </script>
@endsection
