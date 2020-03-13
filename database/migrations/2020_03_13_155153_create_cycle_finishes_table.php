<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCycleFinishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cycle_finishes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("organization_name")->comment("分公司");
            $table->date('date')->comment("完成日期");
            $table->string("category")->comment("週期類別");
            $table->string("custkey")->comment("客戶代碼");
            $table->enum('status',array('Y','N'))->default('N')->comment('是否更新');
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
        Schema::dropIfExists('cycle_finishes');
    }
}
