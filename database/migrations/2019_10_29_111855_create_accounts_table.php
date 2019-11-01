<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id')->comment('組織id');
            $table->bigInteger('department_id')->comment('部門id');
            $table->string('token')->unique()->comment('客戶line token');
            $table->string('cuskey')->comment('客戶代碼');
            $table->string('name')->comment('客戶姓名');
            $table->string('card_number')->comment('卡號');
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
        Schema::dropIfExists('accounts');
    }
}
