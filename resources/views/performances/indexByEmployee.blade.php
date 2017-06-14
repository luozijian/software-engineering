@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    员工业绩
                    <br><br>
                </header>
                <div class="panel-body">
                    @include('flash::message')
                    <div class="panel-body">

                        <form class="form-inline" role="form">
                            <div class="form-group">
                                {!! Form::label('work_id', '工号:') !!}
                                {!! Form::text('work_id',\Request::get("work_id"), ['class' => 'form-control','data-role'=>'search-item','data-name'=>'work_id','data-express'=>'like']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('start_at', '开始时间:') !!}
                                {!! Form::text('start_at',\Request::get("start_at"), ['class' => 'form-control','data-role'=>'date-picker']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('end_at', '结束时间:') !!}
                                {!! Form::text('end_at',\Request::get("end_at"), ['class' => 'form-control','data-role'=>'date-picker']) !!}
                            </div>

                            <input type="hidden" name="search">
                            <input type="hidden" name="searchFields">
                            <button type="button" class="btn btn-success" data-role="search">搜索</button>
                        </form>

                    </div>

                    <table class="table table-responsive" id="performances-table">
                        <thead>
                        <th>员工</th>
                        <th>员工工号</th>
                        <th>职级</th>
                        <th>原始业绩</th>
                        <th>个人业绩</th>
                        <th>团队业绩</th>
                        <th>佣金</th>
                        <th colspan="3">操作</th>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{!! $employee->name !!}</td>
                                <td>{!! $employee->work_id !!}</td>
                                <td>{!! $employee->job_point !!}</td>
                                <td>{!! $employee->original_performance !!}</td>
                                <td>{!! $employee->personal_performance !!}</td>
                                <td>{!! $employee->team_performance !!}</td>
                                <td>{!! $employee->commission !!}</td>
                                <td>
                                    <div class='btn-group'>
                                        <a href="{!! route('performances.index',["search"=>$employee->id,"searchFields"=>"employee_id"]) !!}" class="btn btn-primary btn-xs">查看业绩</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $employees->render() !!}
                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    @include('layouts.datetime')
    <script src="{{ asset("app/js/search.js") }}"></script>
@endsection
