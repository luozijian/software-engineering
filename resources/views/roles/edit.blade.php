@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                     编辑
                </header>
                <div class="panel-body">
                    @include('layouts.errors')
                    <div class="row">
                       {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}
                            @include('roles.fields')
                       {!! Form::close() !!}
                   </div>
                </div>
            </section>
        </div>
    </div>
@endsection