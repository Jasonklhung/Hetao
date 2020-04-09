<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_backs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("organization_name")->comment("分公司");
            $table->date('date')->comment("退料日期");
            $table->string("emp_id")->comment("員編");
            $table->string("emp_name")->comment("員工姓名");
            $table->string("materials_number")->comment("產品料號");
            $table->string("materials_spec")->comment("品名規格");
            $table->string("machine_number")->comment("機號");
            $table->integer("quantity")->comment("數量");
            $table->string("other")->nullable()->comment("備註");
            $table->enum('status',array('Y','N'))->default('N')->comment('是否退料');
            $table->enum('statusDL',array('Y','N'))->default('N')->comment('是否下載');
            $table->enum('statusERP',array('Y','N'))->default('N')->comment('ERP');
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
        Schema::dropIfExists('material_backs');
    }
}
