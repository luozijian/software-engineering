<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('policy_number', '保单编号:') !!}
    {!! Form::text('policy_number', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', '产品:') !!}
    {!! Form::select('product_id', $products, null, ['class' => 'form-control','required']) !!}
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

<!-- Began At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deal_amount', '交易金额:') !!}
    {!! Form::text('deal_amount', null, ['class' => 'form-control','required']) !!}
</div>

@if(!isset($policy))
<!-- Handle Signer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('handle_signer', '处理保单的签单员(填写工号):') !!}
    {!! Form::select('handle_signer', $employees, null, ['class' => 'form-control','required','data-role' => 'work-id select2']) !!}
</div>
{!! Form::hidden('work_id',null,['data-role' => 'work-id-query']) !!}

<!-- Handle Signer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('signer_name', '签单员姓名:') !!}
    {!! Form::text('signer_name', null, ['class' => 'form-control','disabled','data-role' => 'signer-name']) !!}
</div>
@endif


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