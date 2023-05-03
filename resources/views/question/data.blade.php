<div class="box data-table-list">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-md-1">#</th>
                <th class="col-md-5">Question Name</th>
                <th class="col-md-1">Status</th>
                <th class="col-md-2">Posted on</th>
                <th class="col-md-3" style="text-align: right">Action</th>

            </tr>
            </thead>
            <tbody id="pages">
            @foreach($apps as $k=>$row)
                <tr id="{{$row->id}}">
                    <td>{{$page +$k+1}}</td>
                    <td><a href="{{route('home.question',['name'=>$row->permalink])}}" target="_blank">{{decodeContent($row->title)}}</a> </td>
                    <td id="status{{$row->id}}">@php echo ($row->status == 1)?'<span class="label label-success">Approved</span>':'<span class="label label-danger">Not approved</span>' @endphp</td>
                    <td>
                        {{ date('d F, Y',strtotime($row->on))}}
                    </td>
                    <td style="text-align: right">
                        @php echo ($row->status == 1)?'<a href="javascript:void(0);" data-url="'.action('QuestionsController@updatequestion', $row->id) .'" data-type="status" data-val="0" data-id="'.$row->id.'" class="btn btn-primary btn-sm waves-effect _update_data" data-toggle="tooltip" title="Block question"><i class="notika-icon notika-draft"></i> Block</a>':'<a href="javascript:void(0);"
                           data-id="'.$row->id.'" data-toggle="tooltip" title="Approve question" data-type="status" data-val="1" data-url="'.action('QuestionsController@updatequestion', $row->id) .'" class="btn btn-primary btn-sm waves-effect _update_data"><i class="notika-icon notika-draft"></i> Approve</a>' @endphp
                        <a href="javascript:void(0);" data-toggle="tooltip" title="Delete question" data-url="{{ route('questions.destroy',$row->id) }}"
                           data-id="{{$row->id}}" class="btn btn-danger btn-sm waves-effect _delete_data"><i
                                    class="notika-icon notika-trash"></i> Delete</a>
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