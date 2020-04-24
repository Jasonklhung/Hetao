<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCycleAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cycle_assigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kind')->comment('週期類別');
            $table->string('custkey')->comment('客戶代碼');
            $table->string('touch')->comment('承辦人員');
            $table->string('companyTel')->comment('公司電話');
            $table->string('lastDate')->comment('上次日期');
            $table->string('thisDate')->comment('本次日期');
            $table->string('cycle')->comment('週期天數');
            $table->string('area')->comment('區域');
            $table->string('staff')->comment('負責員工');
            $table->string('homeTel')->nullable()->comment('家裡電話');
            $table->string('mobile')->comment('行動電話');
            $table->string('machine')->comment('機器地址');
            $table->string('payAddress')->comment('收款地址');
            $table->string('productCode')->comment('產品代碼');
            $table->string('productNum')->comment('產品數量');
            $table->string('productPrice')->comment('產品價格');
            $table->string('other')->nullable()->comment('備註');
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
        Schema::dropIfExists('cycle_assigns');
    }
}
