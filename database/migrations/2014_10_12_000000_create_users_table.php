<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id')->comment('組織id');
            $table->string('token')->comment('Line token');
            $table->string('name')->comment('姓名');
            $table->string('ID_number')->unique()->comment('身分證字號');
            $table->string('mobile')->unique()->comment('手機');
            $table->string('emp_id')->comment('員工編號');
            $table->string('job')->comment('職稱');
            $table->bigInteger('department_id')->comment('部門id');
            $table->enum('is_verified',array('Y','N'))->default('N')->comment('是否已驗證');
            $table->string('UUID')->nullable()->comment('登入驗證');
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
        Schema::dropIfExists('users');
    }
}
