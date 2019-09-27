<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id')->comment('組織id');
            $table->bigInteger('user_id')->comment('建立此活動的人');
            $table->string('title')->comment('活動標題');
            $table->datetime('start')->comment('開始日期時間');
            $table->datetime('end')->comment('結束日期時間');
            $table->string('position')->nullable()->comment('活動位置');
            $table->string('notice')->nullable()->comment('通知時間');
            $table->string('meeting')->nullable()->comment('參與此活動的人');
            $table->string('description')->nullable()->comment('活動描述');
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
        Schema::dropIfExists('activities');
    }
}
