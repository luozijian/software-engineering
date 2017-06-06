<!-- Id Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">产品:{!! $policy->product->name !!}</div>
	</section>
</div>

<!-- Id Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">签单员工号:{!! $policy->policieable->work_id !!}</div>
	</section>
</div>

<!-- Id Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">签单员姓名:{!! $policy->policieable->name !!}</div>
	</section>
</div>

<!-- Id Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">签单员签单时职级:{!! $policy->job_point !!}</div>
	</section>
</div>

<!-- Number Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">保单编号:{!! $policy->policy_number !!}</div>
	</section>
</div>

<!-- Number Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">佣金几个月发放一次:{!! $policy->commission_rule !!}</div>
	</section>
</div>

<!-- Client Name Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">客户姓名:{!! $policy->client_name !!}</div>
	</section>
</div>

<!-- Client Gender Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">客户性别:{!! $policy->gender !!}</div>
	</section>
</div>

<!-- Client Phone Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">客户电话:{!! $policy->client_phone !!}</div>
	</section>
</div>

<!-- Client Email Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">客户邮箱:{!! $policy->client_email !!}</div>
	</section>
</div>

<!-- Company Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">处理保单的公司:{!! $policy->handle_company !!}</div>
	</section>
</div>

<!-- Repay Year Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">供款年期:{!! $policy->repay_year !!}</div>
	</section>
</div>

<!-- Repay Amount Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">供款额:{!! $policy->repay_amount !!}</div>
	</section>
</div>

<!-- Repay Amount Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">年供款:{!! $policy->repay_amount_year !!}</div>
	</section>
</div>

<!-- Began At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">生效日期:{!! $policy->begin_at->toDateString() !!}</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">是否续费:{!! $policy->isRenewal() ? '是' : '否' !!}</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">应续费日期:{!! $policy->paid_at->toDateString() !!}</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">缴费续费次数:{!! $policy->renewal_count !!}</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">佣金发放次数:{!! $policy->commission_release_count !!}</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">单据核批次数:{!! $policy->review_count !!}</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">单据转单次数:{!! $policy->transfer_count !!}</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">货币:{!! $policy->currency_name !!}</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">单据产生佣金:{!! $policy->commission !!}
			@if($policy->currency)
				港元
			@endif</div>
	</section>
</div>

<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">单据产生业绩:{!! $policy->performance !!}</div>
	</section>
</div>


