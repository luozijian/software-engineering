<div class="panel-body">
    <form class="form-inline" role="form">
        <div class="form-group">
            {!! Form::label('supplier', '产品供应商:') !!}
            {!! Form::text('supplier',\Request::get("supplier"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'supplier','data-express'=>'like']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('plan', '计划名称:') !!}
            {!! Form::text('plan',\Request::get("plan"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'plan','data-express'=>'like']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('status', '状态:') !!}
            {!! Form::select('status',$product_status,\Request::get("status"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'status','data-express'=>'like','style' => 'width:170px']) !!}
        </div>

        <input type="hidden" name="search">
        <input type="hidden" name="searchFields">
        <input type="hidden" name="type" data-name="type" data-role="search-item" data-express="=" value={{\Request::get("type")}}>

        <button type="button" class="btn btn-success" data-role="search" data-search="true">搜索</button>

        <button type="button" class="btn btn-info" data-role="search" data-action="{!! route('products.export') !!}">导出</button>

    </form>
</div>
@section('scripts')
    @parent
    <script src="{{ asset("app/js/search.js") }}"></script>
@endsection