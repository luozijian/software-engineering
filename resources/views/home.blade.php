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
                        <div class="col-lg-8">
                            <!--custom chart start-->
                            <div class="border-head">
                                <h3>收入柱状图</h3>
                            </div>
                            <div class="custom-bar-chart">
                                <ul class="y-axis">
                                    <li><span>100</span></li>
                                    <li><span>80</span></li>
                                    <li><span>60</span></li>
                                    <li><span>40</span></li>
                                    <li><span>20</span></li>
                                    <li><span>0</span></li>
                                </ul>
                                <div class="bar">
                                    <div class="title">JAN</div>
                                    <div class="value tooltips" data-original-title="80%" data-toggle="tooltip" data-placement="top" style="height: 80%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">FEB</div>
                                    <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top" style="height: 50%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">MAR</div>
                                    <div class="value tooltips" data-original-title="40%" data-toggle="tooltip" data-placement="top" style="height: 40%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">APR</div>
                                    <div class="value tooltips" data-original-title="55%" data-toggle="tooltip" data-placement="top" style="height: 55%;"></div>
                                </div>
                                <div class="bar">
                                    <div class="title">MAY</div>
                                    <div class="value tooltips" data-original-title="20%" data-toggle="tooltip" data-placement="top" style="height: 20%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">JUN</div>
                                    <div class="value tooltips" data-original-title="39%" data-toggle="tooltip" data-placement="top" style="height: 39%;"></div>
                                </div>
                                <div class="bar">
                                    <div class="title">JUL</div>
                                    <div class="value tooltips" data-original-title="75%" data-toggle="tooltip" data-placement="top" style="height: 75%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">AUG</div>
                                    <div class="value tooltips" data-original-title="45%" data-toggle="tooltip" data-placement="top" style="height: 45%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">SEP</div>
                                    <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top" style="height: 50%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">OCT</div>
                                    <div class="value tooltips" data-original-title="42%" data-toggle="tooltip" data-placement="top" style="height: 42%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">NOV</div>
                                    <div class="value tooltips" data-original-title="60%" data-toggle="tooltip" data-placement="top" style="height: 60%;"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">DEC</div>
                                    <div class="value tooltips" data-original-title="90%" data-toggle="tooltip" data-placement="top" style="height: 90%;"></div>
                                </div>
                            </div>
                            <!--custom chart end-->
                        </div>
                        <div class="col-lg-4">
                            <!--new earning start-->
                            <div class="panel terques-chart">
                                <div class="panel-body chart-texture">
                                    <div class="chart">
                                        <div class="heading">
                                            <span>星期五</span>
                                            <strong>$ 57,00 | 15%</strong>
                                        </div>
                                        <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"><canvas style="display: inline-block; width: 387px; height: 75px; vertical-align: top;" width="387" height="75"></canvas></div>
                                    </div>
                                </div>
                                <div class="chart-tittle">
                                    <span class="title">公司收入</span>
                                    <span class="value">
                                  <a href="#" class="active">Market</a>
                                  |
                                  <a href="#">Referal</a>
                                  |
                                  <a href="#">Online</a>
                              </span>
                                </div>
                            </div>
                            <!--new earning end-->

                            <!--total earning start-->
                            <div class="panel green-chart">
                                <div class="panel-body">
                                    <div class="chart">
                                        <div class="heading">
                                            <span>六月</span>
                                            <strong>23 日 | 65%</strong>
                                        </div>
                                        <div id="barchart"><canvas width="294" height="65" style="display: inline-block; width: 294px; height: 65px; vertical-align: top;"></canvas></div>
                                    </div>
                                </div>
                                <div class="chart-tittle">
                                    <span class="title">今天收入</span>
                                    <span class="value">$, 76,54,678</span>
                                </div>
                            </div>
                            <!--total earning end-->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <!--script for this page-->
    <script src="/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/js/owl.carousel.js" ></script>
    <script src="/js/jquery.customSelect.min.js" ></script>
    <script class="include" type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>

    <!--script for this page-->
    <script src="/js/sparkline-chart.js"></script>
    <script src="/js/easy-pie-chart.js"></script>
    <script src="/js/count.js"></script>

    <!-- script for tips -->
    <script type="text/javascript" src="/js/modernizr.custom.49511.js"></script>
    <script type="text/javascript" src="/js/jquery.hotspot.min.js"></script>

    <script>
        //owl carousel
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                navigation : true,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem : true,
                autoPlay:true

            });



        });

        //custom select box
        $(function(){
            $('select.styled').customSelect();
        });
    </script>
    @parent
@endsection

