@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    职级
                    {{--<a class="btn btn-primary pull-right" href="{!! route('ranks.create') !!}">新增</a>--}}
                    <br><br>
                </header>
                <div class="panel-body">
                   @include('flash::message')
                   @include('ranks.table')
                   {!! $ranks->render() !!}
                </div>
            </section>
        </div>
    </div>
@endsection

