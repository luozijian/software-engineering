<!-- Job Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('work_id', '工号:') !!}
    {!! Form::text('work_id', null, ['class' => 'form-control',isset($employee)?'disabled':'']) !!}
</div>

<!-- Chinese Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '中文名:') !!}
    {!! Form::text('name', null , ['class' => 'form-control','required']) !!}
</div>

<!-- Job Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rank_id', '职位:') !!}
    {!! Form::select('rank_id', $ranks, null, ['class' => 'form-control','required',isset($employee)?'disabled':'']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', '联系电话:') !!}
    {!! Form::tel('phone', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','required']) !!}
</div>


<!-- Boss Job Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('boss_id', '上司工号(可选):') !!}
    {!! Form::select('boss_id', $bosses, null, ['class' => 'form-control','data-role' => 'boss-id select2']) !!}
</div>

<!-- Boss Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('boss_name', '上司名字:') !!}
    {!! Form::text('boss_name', null, ['class' => 'form-control','disabled','data-role' => 'boss-name']) !!}
</div>

@if(!isset($employee))
    <div class="form-group col-sm-6">
        {!! Form::label('role_id', '角色:') !!}
        {!! Form::select('role_id',$roles, null, ['class' => 'form-control','required']) !!}
    </div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('employees.index') !!}" class="btn btn-default">取消</a>
</div>

@section('scripts')
    @parent
    @include('layouts.datetime')
    <script>
        $(function(){
            $("[data-role*=boss-id]").on("change",function(){
                var i=$(this).val();
                if(i){
                    var url="{{ route('admin.common.bossName') }}?boss_id="+i;
                    $.getJSON(url,{},function(data){
                        if(data.name){
                            $("[data-role=boss-name]").val(data.name);
                        }else{
                            $("[data-role=boss-name]").val("");
                        }
                    });

                }else{
                    $("[data-role=boss-name]").val("");
                }
            });
        })
    </script>
@endsection