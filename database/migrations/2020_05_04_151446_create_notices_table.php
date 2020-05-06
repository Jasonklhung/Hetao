<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('標題');
            $table->string('content')->comment('內容');
            $table->string('category')->comment('分類');
            $table->datetime('startTime')->nullable()->comment('開始日期');
            $table->string('week')->nullable()->comment('每隔幾周');
            $table->string('weekend')->nullable()->comment('星期幾');
            $table->string('weekendTime')->nullable()->comment('每周時間');
            $table->string('meeting')->comment('通知對象');
            $table->string('token')->comment('通知對象token');
            $table->string('type')->comment('通知類型');
            $table->string('other')->nullable()->comment('備註');
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
        Schema::dropIfExists('notices');
    }
}
