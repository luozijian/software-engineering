@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    系统角色
                    <a class="btn btn-primary pull-right" href="{!! route('roles.create') !!}">新增</a>
                    <br><br>
                </header>
                <div class="panel-body">
                    @include('roles.search_fields')
                    @include('flash::message')
                   @include('roles.table')
                   {!! $roles->render() !!}
                </div>
            </section>
        </div>
    </div>
@endsection

