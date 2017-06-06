<table class="table table-responsive" id="ranks-table">
    <thead>
        <th>职位</th>
        <th>职级系数</th>
        <th>晋升所需业绩(单位:百万)</th>
        <th>晋升条件一</th>
        <th>晋升条件二</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($ranks as $rank)
        <tr>
            <td>{!! $rank->name !!}</td>
            <td>{!! $rank->job_point !!}</td>
            <td>{!! $rank->performance_required_display !!}</td>
            <td>{!! $rank->condition1_display !!}</td>
            <td>{!! $rank->condition2_display !!}</td>
            <td>
                不可修改
            </td>
        </tr>
    @endforeach
    </tbody>
</table>