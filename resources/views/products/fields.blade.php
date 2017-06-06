@section('style')
    <style>
        .selector{
            width: 59px;
        }
    </style>
@stop
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '产品名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
</div>

<product-item
        product-type="{!! $product->type or '' !!}"
        product-supplier="{!! $product->supplier or '' !!}"
        product-plan="{!! $product->plan or '' !!}"
        product-year="{!! $product->year or 0 !!}"
        product-rate="{!! $product->rate or 0 !!}"
        :year-period-count="{{ $product->year_period_count or 0 }}"
        :year-period='{!! $product->year_period_json or '[]' !!}'
>

</product-item>

<!-- Begin At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('begin_at', '产品生效日期:') !!}
    {!! Form::text('begin_at', null, ['class' => 'form-control','required','data-role' => 'date-picker']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">取消</a>
</div>

@section('scripts')
    @parent
    @include('layouts.datetime')
@endsection
