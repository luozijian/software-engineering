{!! Form::open(['route' => 'products.import','files'=>true]) !!}

<input type="file" class="btn pull-left" required name="file">

<button class="btn btn-primary pull-left" type="submit">导入</button>

<a href="{!! asset('download/product_template.xlsx') !!}" class='btn btn-success pull-left' style="margin-left:20px" target="_blank">模板下载</a>

{!! Form::close() !!}