@extends('layouts.app')
@section('content')
@section('content_header','Reported Questions')
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
                            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">Reported Questions</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="col-md-2">Report Title</th>
                                    <th class="col-md-3">Report Reason</th>
                                    <th class="col-md-2">Reported by</th>
                                    <th class="col-md-1">Question</th>
                                    <th class="col-md-1">Reported</th>
                                    <th class="col-md-3" style="text-align: right">Action</th>

                                </tr>
                                </thead>
                                <tbody id="pages">
                                @foreach($data as $k=>$row)
                                    <tr id="row{{ $row->id }}">
                                        <td>{{$row->schema->name}}</td>
                                        <td>{{$row->schema->description}}</td>
                                        <td><a target="_blank" href="{{route('user.profile',['id'=>$row->user->id])}}">View
                                                Profile</a></td>
                                        <td><a target="_blank"
                                               href="{{route('home.question',['name'=>$row->question->permalink])}}">View</a>
                                        </td>
                                        <td>{{timeAgo($row->on)}}</td>
                                        <td class="text-right"><a data-id="{{ $row->id }}" data-del="{{$row->id}}"
                                                                  href="javascript:void(0);" data-type="report"
                                                                  class="btn btn-primary btn-sm waves-effect delete_data">Delete
                                                Report
                                            </a>
                                            <a href="javascript:void(0);"
                                               data-id="{{$row->question->id}}"
                                               data-del="{{$row->id}}"
                                               data-type="question"
                                               class="delete_data">
                                                <span class="btn btn-danger btn-sm waves-effect ">Delete Question</span>
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
                        {!! $data->links() !!}
                    </div>
                </div>
                <!-- /.general form elements -->

                @if($data->isEmpty())
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

            $(document).on('click', '.delete_data', function () {
                var id = $(this).data("id");
                var del = 'row' + $(this).data("del");
                var type = $(this).data("type");
                var token = "{{ csrf_token() }}";
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }).then(isConfirmed => {
                    if (isConfirmed) {
                        $.ajax(
                            {
                                url: '{{route('admin.postReport')}}',
                                type: 'POST',
                                data: {
                                    "id": id,
                                    "type": type,
                                    "_token": token,
                                },
                                success: function (data) {
                                    if (data.status) {
                                        swal("Deleted!", data.message, "success");
                                        document.getElementById(del).remove();
                                    } else {
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
