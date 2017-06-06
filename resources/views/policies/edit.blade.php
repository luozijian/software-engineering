@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                     编辑
                </header>
                <div class="panel-body">
                    @include('flatlab-templates::common.errors')
                    @include('flash::message')
                    <div class="row">
                       {!! Form::model($policy, ['route' => ['policies.update', $policy->id], 'method' => 'patch']) !!}

                        @include('policies.fields')

                       {!! Form::close() !!}
                   </div>
                </div>
            </section>
        </div>
    </div>
@endsection