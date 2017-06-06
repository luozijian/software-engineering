<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '用户名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', '帐号:') !!}
    {!! Form::text('email', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', '密码:') !!}
    {!! Form::password('password', ['class' => 'form-control',isset($user)?"":"required"]) !!}
</div>

@if(!isset($user))
    <div class="form-group col-sm-6">
        {!! Form::label('role_id', '角色:') !!}
        {!! Form::select('role_id',$roles, null, ['class' => 'form-control','required']) !!}
    </div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">取消</a>
</div>
