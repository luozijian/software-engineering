@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    业绩发放记录
                    <br><br>
                    个人业绩（总）:{{ $signer->personal_performance or '' }} &nbsp;&nbsp;&nbsp; 团队业绩（总）:{{ $signer->team_performance or '' }}
                </header>
                <div class="panel-body">
                    @include('flash::message')
                   @include('performances.table')
                   {!! $performances->render() !!}
                </div>
            </section>
        </div>
    </div>
@endsection

