<table class="table table-responsive" id="policies-table">
    <thead>
        <th>保单编号</th>
        <th>产品</th>
        <th>签单员</th>
        <th>客户姓名</th>
        <th>客户性别</th>
        <th>客户电话</th>
        <th>客户邮箱</th>
        <th>交易额</th>
        <th>产生业绩</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($policies as $policy)
        <tr>
            <td>{!! $policy->policy_number !!}</td>
            <td>{!! $policy->product->name !!}</td>
            <td>{!! $policy->employee->work_id !!}</td>
            <td>{!! $policy->client_name !!}</td>
            <td>{!! $policy->gender !!}</td>
            <td>{!! $policy->client_phone !!}</td>
            <td>{!! $policy->client_email !!}</td>
            <td>{!! $policy->deal_amount !!}</td>
            <td>{!! $policy->performance !!}</td>
            <td>
                {!! Form::open(['route' => ['policies.destroy', $policy->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('policies.show', [$policy->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>

                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除保单?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>