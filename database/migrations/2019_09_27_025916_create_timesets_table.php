<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id')->comment('組織id');
            $table->string('name')->comment('推播功能名稱');
            $table->string('days')->comment('+-日期');
            $table->time('time')->comment('時間');
            $table->enum('status',array('Y','N'))->default('Y')->comment('是否開啟');
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
        Schema::dropIfExists('timesets');
    }
}
