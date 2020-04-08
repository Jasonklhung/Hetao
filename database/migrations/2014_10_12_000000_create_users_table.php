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
            $table->bigInteger('department_id')->comment('部門id');
            $table->string('organizations')->comment('多個分公司id');
            $table->string('organizations_name')->comment('多個分公司name');
            $table->string('token')->nullable()->unique()->comment('Line token');
            $table->string('name')->comment('姓名');
            $table->string('ID_number')->unique()->comment('身分證字號');
            $table->string('mobile')->unique()->comment('手機');
            $table->string('emp_id')->comment('員工編號');
            $table->string('password')->comment('密碼');
            $table->string('job')->comment('職稱');
            $table->enum('is_verified',array('Y','N'))->default('N')->comment('是否已驗證');
            $table->string('code')->nullable()->comment('簡訊驗證碼');
            $table->string('UUID')->nullable()->unique()->comment('登入驗證');
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
        Schema::dropIfExists('users');
    }
}
