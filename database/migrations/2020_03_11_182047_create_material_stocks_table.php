<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("materials_number")->comment("產品料號");
            $table->string("materials_spec")->comment("品名規格");
            $table->string("machine_number")->comment("機號");
            $table->integer("quantity")->comment("數量");
            $table->string("other")->nullable()->comment("備註");
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
        Schema::dropIfExists('material_stocks');
    }
}
