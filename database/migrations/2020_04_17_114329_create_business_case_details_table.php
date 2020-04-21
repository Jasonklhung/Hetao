<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessCaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_case_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment("userID");
            $table->string('organization_name')->comment("分公司");
            $table->bigInteger('business_track_id')->comment("案件追蹤id");
            $table->string('numbers')->comment("產品型號");
            $table->string('money')->comment("單價");
            $table->string('quantity')->comment("數量");
            $table->string('total')->comment("合計");
            $table->string('description')->nullable()->comment("說明");
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
        Schema::dropIfExists('business_case_details');
    }
}
