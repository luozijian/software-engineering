<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('policy_number', '保单编号:') !!}
    {!! Form::text('policy_number', null, ['class' => 'form-control','required']) !!}
</div>

<policy-item
        :products-of-A='{!! $products_of_A !!}'
        :products-of-B='{!! $products_of_B !!}'
        :product-data='{!! $product_data !!}'
        product-id="{!! $policy->product->id or 0 !!}"
        product-type="{!! $policy->product->type or '' !!}"

>
</policy-item>

<!-- Commission Rule Field -->
<div class="form-group col-sm-6">
    {!! Form::label('commission_rule', '佣金放规则 每几个月发一次:') !!}
    {!! Form::number('commission_rule', null, ['class' => 'form-control',isset($policy) ? 'disabled':'required']) !!}
</div>

<!-- Client Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_name', '客户姓名:') !!}
    {!! Form::text('client_name', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Client Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_gender', '客户性别:') !!}
    {!! Form::select('client_gender', $client_gender , null, ['class' => 'form-control','required']) !!}
</div>

<!-- Client Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_phone', '客户电话:') !!}
    {!! Form::number('client_phone', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Client Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_email', '客户邮箱:') !!}
    {!! Form::email('client_email', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Repay Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('repay_year', '供款年期:') !!}
    {!! Form::number('repay_year', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Repay Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('repay_amount', '供款额:(单位:百万)') !!}
    {!! Form::text('repay_amount', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Handle Company Field -->
<div class="form-group col-sm-6">
    {!! Form::label('handle_company', '处理保单的公司:') !!}
    {!! Form::text('handle_company', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Began At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('begin_at', '保单生效日期:') !!}
    {!! Form::text('begin_at', null, ['class' => 'form-control','required','data-role'=>'date-picker']) !!}
</div>

@if(!isset($policy))
<!-- Handle Signer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('handle_signer', '处理保单的签单员(填写工号或者渠道号):') !!}
    {!! Form::select('handle_signer', $signers, null, ['class' => 'form-control','required','data-role' => 'work-id select2']) !!}
</div>
{!! Form::hidden('work_id',null,['data-role' => 'work-id-query']) !!}

<!-- Handle Signer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('signer_name', '签单员姓名:') !!}
    {!! Form::text('signer_name', null, ['class' => 'form-control','disabled','data-role' => 'signer-name']) !!}
</div>
@endif

<!-- Commission Rule Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency', '币种:') !!}
    {!! Form::select('currency', $currencies, null, ['class' => 'form-control',isset($policy) ? 'disabled':'required']) !!}
</div>

<!-- Paid At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paid_at', '每年缴费日期:') !!}
    {!! Form::text('paid_at', null, ['class' => 'form-control','required','data-role'=>'date-picker']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('policies.index') !!}" class="btn btn-default">取消</a>
</div>

@section('scripts')
    @parent
    <script src="{{ asset("app/js/search.js") }}"></script>
    @include('layouts.datetime')
    <script>
        $(function(){
            $("[data-role*=work-id]").on("change",function(){
                var i=$(this).find("option:selected").text();
                if(i){
                    var url="{{ route('admin.common.signerName') }}?work_id="+i;
                    $.getJSON(url,{},function(data){
                        if(data.name){
                            $("[data-role=signer-name]").val(data.name);
                        }else{
                            $("[data-role=signer-name]").val("");
                        }
                    });
                    $("[data-role=work-id-query]").val(i);
                }else{
                    $("[data-role=signer-name]").val("");
                }
            });
        })
    </script>
@endsection