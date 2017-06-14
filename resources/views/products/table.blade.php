<table class="table table-responsive" id="products-table">
    <thead>
        <th>产品名称</th>
        <th>产品价格</th>
        <th>状态</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{!! $product->name !!}</td>
            <td>{!! $product->price !!}</td>
            @if($product->isOpen())
                <td><span class="label label-success">开启</span></td>
            @else
                <td><span class="label label-danger">关闭</span></td>
            @endif
            <td>
                {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @if($product->isOpen())
                        <a href="{!! route('products.edit', [$product->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon">关闭</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endif
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>