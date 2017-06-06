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
                    <div class="row">
                       {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch']) !!}

                        @include('products.fields')

                       {!! Form::close() !!}
                   </div>
                </div>
            </section>
        </div>
    </div>
@endsection