{!! Form::open(['route' => 'policies.import','files'=>true]) !!}

<input type="file" class="btn pull-left" required name="file">

<button class="btn btn-primary pull-left" type="submit">导入</button>

<a class="btn pull-left btn-success" type="submit" style="margin-left:20px" href="{{asset('download/policy_template.xlsx')}}" target="_blank">模板下载</a>

{!! Form::close() !!}