@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    查看
                </header>
                <div class="panel-body show-panel">
                    @include('flatlab-templates::common.errors')
                    <div class="row">
                       @include('ranks.show_fields')
                        <a href="{!! route('ranks.index') !!}" class="btn btn-default">后退</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
