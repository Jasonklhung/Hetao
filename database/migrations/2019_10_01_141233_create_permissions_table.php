<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment('userID');
            $table->enum('overview',array('Y','N'))->default('Y')->comment('總覽權限');
            $table->enum('notice',array('Y','N'))->default('Y')->comment('通知設定權限');
            $table->enum('assistant',array('Y','N'))->default('N')->comment('個人工單權限');
            $table->enum('supervisor',array('Y','N'))->default('N')->comment('全站工單權限');
            $table->enum('staff',array('Y','N'))->default('N')->comment('工單進度權限');
            $table->enum('cycle_self',array('Y','N'))->default('N')->comment('個人週期權限');
            $table->enum('cycle_all',array('Y','N'))->default('N')->comment('全站週期權限');
            $table->enum('cycle_now',array('Y','N'))->default('N')->comment('週期進度權限');
            $table->enum('material',array('Y','N'))->default('N')->comment('領料申請權限');
            $table->enum('material_case',array('Y','N'))->default('N')->comment('料單管理權限');
            $table->enum('material_stock',array('Y','N'))->default('N')->comment('庫存管理權限');
            $table->enum('custom_info',array('Y','N'))->default('N')->comment('客戶資料查詢權限');
            $table->enum('business_self',array('Y','N'))->default('N')->comment('個人業務權限');
            $table->enum('business_all',array('Y','N'))->default('N')->comment('全站業務權限');
            $table->enum('performance_self',array('Y','N'))->default('N')->comment('個人業績權限');
            $table->enum('performance_all',array('Y','N'))->default('N')->comment('全站業績權限');
            $table->enum('reservation',array('Y','N'))->default('N')->comment('表單-線上預約權限');
            $table->enum('satisfaction',array('Y','N'))->default('N')->comment('表單-滿意度調查權限');
            $table->enum('contact',array('Y','N'))->default('N')->comment('表單-與我聯繫權限');
            $table->enum('timeset',array('Y','N'))->default('N')->comment('推播設定權限');
            $table->enum('permission',array('Y','N'))->default('N')->comment('權限');
            $table->enum('contactUs',array('Y','N'))->default('N')->comment('與我聯繫權限');
            $table->enum('satisfactionSurvey',array('Y','N'))->default('N')->comment('滿意度調查權限');
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
        Schema::dropIfExists('permissions');
    }
}
