<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment('主管userId');
            $table->string('case_id')->comment('工單編號');
            $table->string('cuskey')->comment('客戶代碼');
            $table->string('mobile')->comment('手機號碼');
            $table->string('GUI_number')->comment('統編');
            $table->string('address')->comment('地址');
            $table->string('reason')->comment('派工原因');
            $table->string('work_type')->comment('工作類別');
            $table->date('time')->comment('工單時間');
            $table->string('owner')->comment('負責人');
            $table->string('status')->comment('狀態');
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
        Schema::dropIfExists('supervisor_cases');
    }
}