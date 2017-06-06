@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    发放佣金
                </header>
                <div class="panel-body">
                    @include('flatlab-templates::common.errors')
                    <div class="row">
                        {!! Form::open(['route' => ['policies.storeReleaseRecord',$policy->id]]) !!}

                        <!-- Release By Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('release_by', '发放方式:') !!}
                            {!! Form::select('release_by',$commission_release_by, null , ['class' => 'form-control','required']) !!}
                        </div>

                        <!-- Released At Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('released_at', '发放时间:') !!}
                            {!! Form::text('released_at', null, ['class' => 'form-control','required','data-role'=>'date-picker']) !!}
                        </div>

                        <!-- Current Count Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('current_count', '当前是第几次发放:') !!}
                            {!! Form::number('current_count', $policy->commission_release_count , ['class' => 'form-control','disabled']) !!}
                        </div>

                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('policies.index') !!}" class="btn btn-default">取消</a>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    @include('layouts.datetime')
@endsection
