@extends('layouts.app')
@section('content')
@section('content_header', 'Users')
<div class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-app"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Users</h2>
                                    <p>All Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-b-15">
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
                <div class="inbox-text-list sm-res-mg-t-30">
                    <div class="form-group">
                        <div class="nk-int-st search-input search-overt">
                            <input type="text" id="txtsearch" class="form-control" placeholder="Search ...">
                            <button class="btn search-ib waves-effect" id="search-ib">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="table_data">
            @include('users.data')
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var input = document.getElementById("txtsearch");
            input.addEventListener("keyup", function (event) {
                // Number 13 is the "Enter" key on the keyboard
                if (event.keyCode === 13) {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    document.getElementById("search-ib").click();
                }
            });
            input.addEventListener("focusout", function (event) {
                document.getElementById("search-ib").click();
            });
            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var text = $('#txtsearch').val();
                var page = $(this).attr('href').split('page=')[1];
                if (text != '')
                    fetch_data(page, text);
                else fetch_data(page);
            });
            $(document).on('click', '#search-ib', function (event) {
                event.preventDefault();
                var text = $('#txtsearch').val();
                var page = 1;
                fetch_data(page, text);
            });

            $(document).on('click', '._update_data', function () {
                var id = $(this).data("id");
                var url = $(this).data("url");
                var type = $(this).data("type");
                var val = $(this).data("val");
                var token = $("meta[name='csrf-token']").attr("content");
                var that = $(this);
                var text = '';
                var text1 = '';
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want update this user?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, do it!",
                    closeOnConfirm: false
                }).then(isConfirmed => {
                    if (isConfirmed) {
                        $.ajax(
                            {
                                url: url,
                                type: 'POST',
                                data: {
                                    "id": id,
                                    "type": type,
                                    "val": val,
                                    "_token": token,
                                },
                                success: function (data) {
                                    if (data.status) {
                                        swal("Success!", "User has been update.", "success");
                                        if (type == 'role') {
                                            if (val == 1) {
                                                text = 'Make Moderator';
                                                text1 = 'No';
                                                value = 2;

                                            } else {
                                                text = 'Remove Moderator';
                                                text1 = 'Yes';
                                                value = 1;
                                            }
                                            $('#role' + id).text(text1);
                                        } else {
                                            if (val == 0) {
                                                text = 'Approve Account';
                                                text1 = '<span class="label label-danger">Not approved</span>';
                                                value = 1;
                                            } else {
                                                text = 'Block Account';
                                                text1 = '<span class="label label-success">Approved</span>';
                                                value = 0;
                                            }
                                            $('#status' + id).html(text1);
                                        }
                                        that.data('val', value);
                                        that.text(text);
                                    } else {
                                        swal("Error!", data.message, "error");
                                    }
                                }
                            });
                    }
                });
            });

            function fetch_data(page, text = null) {
                if (text === null)
                    var url = "{{ route('admin.getuser') }}?page=" + page;
                else var url = "{{ route('admin.getuser') }}?page=" + page + "&text=" + text;
                $.ajax({
                    url: url,
                    success: function (data) {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>
@endsection
