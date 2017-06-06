@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    查看员工业绩
                </header>
                <div class="panel-body show-panel">
                    @include('flatlab-templates::common.errors')
                    <div class="row">
                       @include('employees.show_fields')
                        <a href="{!! route('employees.index') !!}" class="btn btn-default">后退</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
