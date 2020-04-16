<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment("userID");
            $table->string('organization_name')->comment("分公司");
            $table->date('date')->comment("拜訪日期");
            $table->string('business_name')->comment("業務名稱");
            $table->string('time')->comment("拜訪時間");
            $table->string('name')->comment("業主名稱");
            $table->string('type')->comment("拜訪類型");
            $table->string('content')->comment("拜訪內容");
            $table->string('city')->comment("縣市");
            $table->string('area')->comment("區域");
            $table->string('address')->comment("地址");
            $table->string('phone')->comment("連絡電話");
            $table->string('other')->nullable()->comment("備註其他");
            $table->string('file')->nullable()->comment("檔案路徑");
            $table->enum('statusOpen',array('Y','N'))->default('N')->comment('是否發布');
            $table->enum('statusTrack',array('Y','N'))->default('N')->comment('是否追蹤');
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
        Schema::dropIfExists('businesses');
    }
}
