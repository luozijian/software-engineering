<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('rank_id')->comment('职级id');
            $table->integer('boss_id')->default(0)->comment('上级id');
            $table->string('work_id')->comment('工号');
            $table->string('name')->comment('中文名');
            $table->string('phone')->comment('电话');
            $table->string('email')->comment('邮箱');
            $table->unsignedInteger('performance')->default(0)->comment('总业绩');
            $table->string('status')->default('on')->comment('off为离职，on为在职');
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
        Schema::drop('employees');
    }
}
