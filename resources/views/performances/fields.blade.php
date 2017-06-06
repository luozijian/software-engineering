<!-- Repay Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('repay_amount', 'Repay Amount:') !!}
    {!! Form::number('repay_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Repay Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('repay_year', 'Repay Year:') !!}
    {!! Form::number('repay_year', null, ['class' => 'form-control']) !!}
</div>

<!-- Repay Amount Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('repay_amount_year', 'Repay Amount Year:') !!}
    {!! Form::number('repay_amount_year', null, ['class' => 'form-control']) !!}
</div>

<!-- Job Point Diff Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_point_diff', 'Job Point Diff:') !!}
    {!! Form::number('job_point_diff', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_rate', 'Product Rate:') !!}
    {!! Form::number('product_rate', null, ['class' => 'form-control']) !!}
</div>

<!-- Bv Point Sum Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BV_point_sum', 'Bv Point Sum:') !!}
    {!! Form::number('BV_point_sum', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('performances.index') !!}" class="btn btn-default">取消</a>
</div>
