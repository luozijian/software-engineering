<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoliciesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('保单对应产品');
            $table->integer('employee_id')->comment('保单所属员工id');
            $table->string('policy_number')->comment('保单编号');
            $table->string('client_name')->comment('客户姓名');
            $table->integer('client_gender')->comment('客户性别,0->女,1->男');
            $table->string('client_phone')->comment('客户电话');
            $table->string('client_email')->comment('客户邮箱');
            $table->float('job_point')->comment('处理保单的签单员职级系数');
            $table->float('deal_amount')->comment('交易金额');
            $table->unsignedInteger('performance')->default(0)->comment('业绩');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('policies');
    }
}
