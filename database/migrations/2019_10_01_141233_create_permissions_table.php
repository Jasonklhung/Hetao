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
            $table->enum('assistant',array('Y','N'))->default('N')->comment('助理頁面權限');
            $table->enum('supervisor',array('Y','N'))->default('N')->comment('主管頁面權限');
            $table->enum('staff',array('Y','N'))->default('N')->comment('員工頁面權限');
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
