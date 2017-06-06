<table class="table table-responsive" id="performances-table">
    <thead>
        <th>员工/渠道</th>
        <th>员工工号/渠道号</th>
        <th>产品</th>
        <th>保单编号</th>
        <th>职级</th>
        <th>职级差</th>
        <th>业绩类型</th>
        <th>所得业绩</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($performances as $performance)
        <tr>
            <td>{!! $performance->performanceable->name !!}</td>
            <td>{!! $performance->performanceable->work_id !!}</td>
            <td>{!! $performance->product->name !!}</td>
            <td>{!! $performance->policy->policy_number !!}</td>
            <td>{!! $performance->job_point !!}</td>
            <td>{!! $performance->job_point_diff !!}</td>
            <td>{!! $performance->type_name !!}</td>
            <td>{!! $performance->release_amount !!}</td>
            <td>
                <a href="{!! route('policies.show', [$performance->policy->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>