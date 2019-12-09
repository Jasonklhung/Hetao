<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSatisfactionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satisfaction_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('account_id')->comment('客戶 account id');
            $table->json('form')->comment('整包表單內容');
            $table->string('case_id')->comment('工單id');
            $table->string('owner')->comment('負責員工');
            $table->enum('status',array('Y','N'))->default('N')->comment('狀態');
            $table->enum('views',array('Y','N'))->default('N')->comment('是否查看');
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
        Schema::dropIfExists('satisfaction_answers');
    }
}
