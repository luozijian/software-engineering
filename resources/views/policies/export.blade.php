<html>
    <table class="table table-responsive">
        <tr>
            <td>产品</td>
            <td>产品供应商</td>
            <td>计划名称</td>
            <td>年期段</td>
            <td>咨询费</td>
        </tr>
        @foreach($policies as $policy)
            @if($policy['product']['year_period'])
                @for($i=0;$i<$policy['product']['year_period_count'];$i++)
                <tr>
                    @if($i == 0)
                        <td>{!! $policy['product']['name']!!}</td>
                    @else
                        <td></td>
                    @endif
                    <td>{!! $policy['product']['supplier']!!}</td>
                    <td>{!! $policy['product']['plan'] !!}</td>
                    <td>{!! $policy['product']['year_period'][$i]['start'] !!}－{!! $policy['product']['year_period'][$i]['end'] !!}</td>
                    <td>{!! $policy['product']['year_period'][$i]['rate'] !!}</td>
                </tr>
                @endfor
            @else
                <tr>
                    <td>{!! $policy['product']['name']!!}</td>
                    <td>无</td>
                    <td>无</td>
                    <td>无</td>
                    <td>{!! $policy['product']['rate']!!}</td>
                </tr>
            @endif
        @endforeach
    </table>
</html>