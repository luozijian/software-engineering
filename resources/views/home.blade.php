@extends('layouts.app')

@section('style')
    @parent
    <link rel="stylesheet" href="/css/jquery.hotspot.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    首页
                    <br><br>
                </header>
                <div class="panel-body">
                    <div class="row">
                        {{--销售记录--}}
                        <div id="sales" style="width:100%;height:100%"></div>
                        {{--销售记录--}}
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{asset('js/highcharts.js')}}"></script>

    <script>

        $(document).ready(function (){
            statistic();
        });
        function statistic(){
            var series = '{!! $series !!}';
            var products = '{!! $products !!}';

            $('#sales').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: '本月产品销售记录条形图'
                },
                xAxis: {
                    categories: JSON.parse(products)
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '产品销售记录'
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal'
                    }
                },
                series:
                    JSON.parse(series)

            });
        }


    </script>
@endsection

