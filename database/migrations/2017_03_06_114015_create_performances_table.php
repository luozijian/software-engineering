<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerformancesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('对应产品id');
            $table->integer('policy_id')->comment('对应保单id');
            $table->integer('employee_id')->comment('业绩所属员工id');
            $table->float('job_point')->comment('签单员当时的职级');
            $table->unsignedInteger('deal_amount')->comment('交易金额');
            $table->unsignedInteger('release_amount')->comment('当前发放业绩');
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
        Schema::drop('performances');
    }
}
