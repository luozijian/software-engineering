<!-- Name Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">产品名称:{!! $product->name !!}</div>
	</section>
</div>

<!-- Supplier Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">产品供应商:{!! $product->supplier !!}</div>
	</section>
</div>

<!-- Plan Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">计划名称:{!! $product->plan !!}</div>
	</section>
</div>

<!-- Year Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">年期:{!! $product->year !!}</div>
	</section>
</div>

<!-- Year Period Count Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">年期段:{!! $product->year_period_count !!}</div>
	</section>
</div>

<!-- Year Period Field -->
@foreach($product->year_period as $key => $item)
	<div class="col-md-6">
		<section class="panel">
			<div class="panel-body">
				第{{$key+1}}段年期倍数:第{!! $item['start'] !!}年--第{!! $item['end'] !!}年,{!! $item['rate'] !!}%
			</div>
		</section>
	</div>
@endforeach
