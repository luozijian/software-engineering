@extends('layouts.app')
@section("style")
    <style>
        #main-content {
             margin-left: 0px;
        }
    </style>
@endsection
@section('title')
        财务
@endsection
@section('content')
    <form class="form-signin" method="post">
        {!! csrf_field() !!}
        <div class="login-wrap">
            <div class="form-group has-feedback {!! $errors->has('email') ? ' has-error' : '' !!}">
                <input type="text" class="form-control" name="email" value="{!! old('email') !!}" placeholder="帐号">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{!! $errors->first('email') !!}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback{!! $errors->has('password') ? ' has-error' : '' !!}">
                <input type="password" class="form-control" placeholder="密码" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{!! $errors->first('password') !!}</strong>
                </span>
                @endif
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> 记住登录
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">登录系统</button>
        </div>
    </form>
@endsection


