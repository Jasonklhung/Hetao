<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_tracks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('business_id')->comment("業務-拜訪id");
            $table->date('date_again')->comment("覆訪日期");
            $table->string('level')->comment("客戶等級");
            $table->string('schedule')->comment("案件進度");
            $table->string('category')->comment("客戶類別");
            $table->string('uniform_numbers')->comment("統編");
            $table->string('email')->comment("信箱");
            $table->string('result')->comment("結果");
            $table->string('reason')->comment("原因");
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
        Schema::dropIfExists('business_tracks');
    }
}
