<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '产品名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', '产品价格:') !!}
    {!! Form::text('price', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">取消</a>
</div>

