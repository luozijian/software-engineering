<table class="table table-responsive" id="policies-table">
    <thead>
        <th>保单编号</th>
        <th>签单员</th>
        <th>客户姓名</th>
        <th>客户性别</th>
        <th>客户电话</th>
        <th>客户邮箱</th>

        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($policies as $policy)
        <tr>
            <td>{!! $policy->policy_number !!}</td>
            <td>{!! $policy->policieable->work_id !!}</td>
            <td>{!! $policy->client_name !!}</td>
            <td>{!! $policy->gender !!}</td>
            <td>{!! $policy->client_phone !!}</td>
            <td>{!! $policy->client_email !!}</td>
            <td>
                {!! Form::open(['route' => ['policies.destroy', $policy->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('policies.show', [$policy->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @if(!$policy->isRenewal())
                        @if($policy->renewal_count)
                            <a href="{!! route('policies.renewal',[$policy->id]) !!}" class="btn btn-success btn-xs">续费</a>
                        @else
                            <a href="{!! route('policies.renewal',[$policy->id]) !!}" class="btn btn-success btn-xs">缴费</a>
                        @endif
                    @else
                        <a href="{!! route('policies.review',[$policy->id]) !!}" class="btn btn-primary btn-xs">核批</a>
                        <a href="{!! route('policies.release',[$policy->id]) !!}" class="btn btn-success btn-xs">发放佣金</a>
                        <a href="{!! route('policies.transfer',[$policy->id]) !!}" class="btn btn-primary btn-xs">转单</a>
                        <a href="{!! route('transfers.index',["search"=>$policy->id,"searchFields"=>"policy_id"]) !!}" class="btn btn-warning btn-xs">转单记录</a>
                    @endif
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除保单?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>