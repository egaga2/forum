<div class="box data-table-list">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-md-1">#</th>
                <th class="col-md-2">Email</th>
                <th class="col-md-2">Name</th>
                <th class="col-md-1">Reputation</th>
                <th class="col-md-2">Moderator</th>
                <th class="col-md-2">Status</th>
                <th class="col-md-2">Registered on</th>
                <th class="col-md-2">Action</th>
            </tr>
            </thead>
            <tbody id="pages">
            @foreach($apps as $k=>$row)
                <tr>
                    <td>{{$page +$k+1}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->votes}}</td>
                    <td id="role{{$row->id}}">@php echo ($row->role == 1)?'No':'Yes'; @endphp</td>
                    <td id="status{{$row->id}}">@php echo ($row->status == 1)?'<span class="label label-success">Approved</span>':'<span class="label label-danger">Not approved</span>'; @endphp</td>
                    <td>
                        {{ date('d F, Y',strtotime($row->on))}}
                    </td>
                    <td>@php echo ($row->role == 1)?'<a href="javascript:void(0);"
                           data-id="'.$row->id.'" data-url="'.action('UsersController@updateuser', $row->id) .'" data-type="role" data-val="2" class="label label-success _update_data">Make Moderator</a>':'<a href="javascript:void(0);"
                           data-id="'.$row->id.'" data-url="'.action('UsersController@updateuser', $row->id) .'" data-type="role" data-val="1" class="label label-success _update_data">Remove Moderator</a>' @endphp
                        @php echo ($row->status == 1)?'<a href="javascript:void(0);" data-url="'.action('UsersController@updateuser', $row->id) .'" data-type="status" data-val="0" data-id="'.$row->id.'" class="label label-primary _update_data">Block Account</a>':'<a href="javascript:void(0);"
                           data-id="'.$row->id.'" data-type="status" data-val="1" data-url="'.action('UsersController@updateuser', $row->id) .'" class="label label-primary _update_data">Approve Account</a>' @endphp

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-inbox text-center">
        {!! $apps->links() !!}
    </div>
</div>