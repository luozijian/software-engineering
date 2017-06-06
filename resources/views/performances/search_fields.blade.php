<div class="panel-body">
    <form class="form-inline" role="form">

        <div class="col-md-2">
            {!! Form::label('type', '业绩类型:') !!}
            {!! Form::select('type', $performance_type, \Request::get("type"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'type','data-express'=>'like','style' => 'width:170px']) !!}
        </div>

        {!! Form::hidden('performanceable_id',$signer ? $signer->id : \Request::get("performanceable_id"),['data-role'=>'search-item','data-name'=>'performanceable_id','data-express'=>'=']) !!}
        {!! Form::hidden('performanceable_type',$performanceable_type ? $performanceable_type : \Request::get("performanceable_type"),['data-role'=>'search-item','data-name'=>'performanceable_type','data-express'=>'like']) !!}

        <input type="hidden" name="search">
        <input type="hidden" name="searchFields">

        <button type="button" class="btn btn-success" style="margin-top: 22px" data-role="search">搜索</button>

    </form>
</div>
@section('scripts')
    @parent
    @include('layouts.datetime')
    <script src="{{ asset("app/js/search.js") }}"></script>
@endsection