<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '职位:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Job Point Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_point', '职级系数:') !!}
    {!! Form::text('job_point', null, ['class' => 'form-control']) !!}
</div>

<!-- Personal Performance Required Field -->
<div class="form-group col-sm-6">
    {!! Form::label('personal_performance_required', '所需个人业绩:') !!}
    {!! Form::number('personal_performance_required', null, ['class' => 'form-control']) !!}
</div>

<!-- Team Performance Required Field -->
<div class="form-group col-sm-6">
    {!! Form::label('team_performance_required', '所需团队业绩:') !!}
    {!! Form::number('team_performance_required', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ranks.index') !!}" class="btn btn-default">取消</a>
</div>
