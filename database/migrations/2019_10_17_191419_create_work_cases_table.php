<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment('填表人id');
            $table->bigInteger('department_id')->comment('部門');
            $table->string('type')->comment('工作類型');
            $table->string('cusKey')->comment('客戶代碼');
            $table->enum('online',array('W','N'))->default('N')->comment('是否為線上預約');
            $table->string('address')->comment('聯絡地址');
            $table->string('mobile')->comment('聯絡電話');
            $table->string('reason')->comment('派工原因');
            $table->datetime('datetime')->comment('工單日期');
            $table->enum('urgent',array('true','false'))->default('false')->comment('是否為急件');
            $table->string('remarks')->comment('備註');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_cases');
    }
}
