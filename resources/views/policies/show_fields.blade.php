<!-- Id Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">产品:{!! $policy->product->name or '' !!}</div>
	</section>
</div>

<!-- Id Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">签单员工号:{!! $policy->employee->work_id !!}</div>
	</section>
</div>

<!-- Id Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">签单员姓名:{!! $policy->employee->name !!}</div>
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


<!-- Repay Amount Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">交易额:{!! $policy->deal_amount !!}</div>
	</section>
</div>


<!-- Paid At Field -->
<div class="col-md-6">
	<section class="panel">
		<div class="panel-body">单据产生业绩:{!! $policy->performance !!}</div>
	</section>
</div>


