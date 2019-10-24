<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSatisfactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satisfactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('表單名稱');
            $table->json('form')->comment('整包表單內容');
            $table->json('node')->nullable()->comment('跳轉節點');
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
        Schema::dropIfExists('satisfactions');
    }
}
