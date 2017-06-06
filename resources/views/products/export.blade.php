<html>
    <table class="table table-responsive">
        <tr>
            <td>产品名称</td>
            <td>产品类型</td>
            <td>产品供应商</td>
            <td>计划名称</td>
            <td>年期</td>
            <td>年期段</td>
            <td>倍数</td>
            <td>产品生效日期</td>
            <td>第一段年期开始</td>
            <td>第一段年期结束</td>
            <td>第一段年期倍数</td>
            <td>第二段年期开始</td>
            <td>第二段年期结束</td>
            <td>第二段年期倍数</td>
            <td>第三段年期开始</td>
            <td>第三段年期结束</td>
            <td>第三段年期倍数</td>
            <td>第四段年期开始</td>
            <td>第四段年期结束</td>
            <td>第四段年期倍数</td>
            <td>第五段年期开始</td>
            <td>第五段年期结束</td>
            <td>第五段年期倍数</td>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product['name']}}</td>
                <td>{{ $product['type']}}</td>
                <td>{!! $product['supplier']!!}</td>
                <td>{!! $product['plan']!!}</td>
                <td>{!! $product['year']!!}</td>
                <td>{!! $product['year_period_count']!!}</td>
                <td>{!! $product['rate']!!}</td>
                <td>{!! $product['begin_at']!!}</td>
                @foreach($product['year_period'] as $item)
                <td>{!! $item['start'] !!}</td>
                <td>{!! $item['end'] !!}</td>
                <td>{!! $item['rate'] !!}
                @endforeach
            </tr>
        @endforeach
    </table>
</html>