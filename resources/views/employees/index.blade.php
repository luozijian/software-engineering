@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    员工
                    <a class="btn btn-primary pull-right" href="{!! route('employees.create') !!}">新增</a>
                    <br><br>
                </header>
                <div class="panel-body">
                    @include('employees.search_fields')
                    @include('flash::message')
                    @include('employees.table')
                    {!! $employees->render() !!}
                </div>
            </section>
        </div>
    </div>
@endsection

