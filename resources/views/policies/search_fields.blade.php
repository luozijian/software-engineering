<div class="panel-body">
    <form class="form-inline" role="form">
        <div class="col-md-2">
            {!! Form::label('supplier', '供应商:') !!}
            {!! Form::text('supplier',\Request::get("supplier"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'product.supplier','data-express'=>'like']) !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('plan', '计划名:') !!}
            {!! Form::text('plan',\Request::get("plan"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'product.plan','data-express'=>'like']) !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('policy_number', '保单编号:') !!}
            {!! Form::text('policy_number',\Request::get("policy_number"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'policy_number','data-express'=>'like']) !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('client_name', '客户姓名:') !!}
            {!! Form::text('client_name',\Request::get("client_name"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'client_name','data-express'=>'like']) !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('client_phone', '客户电话:') !!}
            {!! Form::text('client_phone',\Request::get("client_phone"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'client_phone','data-express'=>'like']) !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('begin_at', '保单生效日期:') !!}
            {!! Form::text('begin_at',\Request::get("begin_at"), ['class' => 'form-control','data-role'=>'search-item month-picker','data-name'=>'begin_at','data-express'=>'like']) !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('client_gender', '客户性别:') !!}
            {!! Form::select('client_gender',$genders,\Request::get("client_gender"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'client_gender','data-express'=>'like','style' => 'width:170px']) !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('handle_company', '保单公司:') !!}
            {!! Form::text('handle_company',\Request::get("handle_company"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'handle_company','data-express'=>'like']) !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('type', '产品类型:') !!}
            {!! Form::select('type', $product_types, \Request::get("type"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'product.type','data-express'=>'like','style' => 'width:170px']) !!}
        </div>

        <input type="hidden" name="search">
        <input type="hidden" name="searchFields">

        <button type="button" class="btn btn-success" style="margin-top: 22px" data-role="search">搜索</button>

        <button type="button" class="btn btn-info" style="margin-top: 22px" data-role="search" data-action="{!! route('policies.export') !!}">导出</button>

    </form>
</div>
@section('scripts')
    @parent
    @include('layouts.datetime')
    <script src="{{ asset("app/js/search.js") }}"></script>
@endsection