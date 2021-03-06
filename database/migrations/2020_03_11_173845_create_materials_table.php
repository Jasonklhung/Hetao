<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("organization_name")->comment("分公司");
            $table->date('date')->comment("領料日期");
            $table->string("emp_id")->comment("員編");
            $table->string("emp_name")->comment("員工姓名");
            $table->string("materials_number")->comment("產品料號");
            $table->string("materials_spec")->comment("品名規格");
            $table->string("machine_number")->comment("機號");
            $table->integer("quantity")->comment("數量");
            $table->string("other")->nullable()->comment("備註");
            $table->enum('status',array('Y','N'))->default('N')->comment('是否領料');
            $table->enum('statusEdit',array('Y','N'))->default('N')->comment('是否編輯');
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
        Schema::dropIfExists('materials');
    }
}
