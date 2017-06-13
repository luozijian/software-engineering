<table class="table table-responsive" id="employees-table">
    <thead>
        <th>工号</th>
        <th>中文名</th>
        <th>职位</th>
        <th>职级点</th>
        <th>联系电话</th>
        <th>Email</th>
        <th>上司工号</th>
        <th>上司名字</th>
        <th>状态</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{!! $employee->work_id !!}</td>
            <td>{!! $employee->name !!}</td>
            <td>{!! $employee->rank->name !!}</td>
            <td>{!! $employee->job_point !!}</td>
            <td>{!! $employee->phone !!}</td>
            <td>{!! $employee->email !!}</td>
            <td>{!! $employee->boss_work_id !!}</td>
            <td>{!! $employee->boss_name !!}</td>
            @if($employee->isOn())
                <td><span class="label label-success">在职</span></td>
            @else
                <td><span class="label label-danger">离职</span></td>
            @endif
            <td>
                {!! Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('policies.index', ["search"=>$employee->id,"searchFields"=>"employee_id"]) !!}" class='btn btn-success btn-xs'>保单</a>
                    <a href="{!! route('performances.index', ["search"=>$employee->id,"searchFields"=>"employee_id"]) !!}" class='btn btn-send btn-xs'>业绩</a>
                    @if($employee->isOn())
                        <a href="{!! route('employees.edit', [$employee->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon">离职</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('是否确定离职?')"]) !!}
                    @endif
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>