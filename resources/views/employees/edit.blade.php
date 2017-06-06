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
                       {!! Form::model($employee, ['route' => ['employees.update', $employee->id], 'method' => 'patch']) !!}

                        @include('employees.fields')

                       {!! Form::close() !!}
                   </div>
                </div>
            </section>
        </div>
    </div>
@endsection