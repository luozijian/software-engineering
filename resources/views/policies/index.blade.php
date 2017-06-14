@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    保单
                    <a class="btn btn-primary pull-right" href="{!! route('policies.create') !!}">新增</a>
                    <br><br>
                </header>
                <div class="panel-body">
                    @include('flash::message')
                   @include('policies.table')
                   {!! $policies->render() !!}
                </div>
            </section>
        </div>
    </div>
@endsection

