<table class="table table-responsive" id="ranks-table">
    <thead>
        <th>职位</th>
        <th>职级系数</th>
        <th>晋升所需业绩(元)</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($ranks as $rank)
        <tr>
            <td>{!! $rank->name !!}</td>
            <td>{!! $rank->job_point !!}</td>
            <td>{!! $rank->performance_required !!}</td>
            <td>
                不可修改
            </td>
        </tr>
    @endforeach
    </tbody>
</table>