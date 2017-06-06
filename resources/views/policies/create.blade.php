@extends('layouts.app')

@section('content')
 <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    新增
                </header>
                <div class="panel-body">
                    @include('flatlab-templates::common.errors')
                    @include('flash::message')
                    <div class="row">
                        {!! Form::open(['route' => 'policies.store']) !!}

                                  @include('policies.fields')

                        {!! Form::close() !!}
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection
