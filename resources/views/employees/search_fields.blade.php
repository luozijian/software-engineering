<div class="panel-body">
    <form class="form-inline" role="form">
        <div class="form-group">
            {!! Form::label('work_id', '工号:') !!}
            {!! Form::text('work_id',\Request::get("work_id"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'work_id','data-express'=>'like']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name', '中文名字:') !!}
            {!! Form::text('name',\Request::get("name"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'name','data-express'=>'like']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name', '英文名字:') !!}
            {!! Form::text('english_name',\Request::get("english_name"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'english_name','data-express'=>'like']) !!}
        </div>

        <input type="hidden" name="search">
        <input type="hidden" name="searchFields">
        <button type="button" class="btn btn-success" data-role="search">搜索</button>

    </form>
</div>
@section('scripts')
    @parent
    <script src="{{ asset("app/js/search.js") }}"></script>
@endsection