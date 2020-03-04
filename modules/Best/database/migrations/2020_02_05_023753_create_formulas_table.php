<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->index();
            $table->longtext('value')->nullable();
            $table->string('group')->index();
            $table->string('type')->index()->default('report');
            $table->longtext('metadata')->nullable();
            $table->morphs('reportable');
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('taxonomy_id')->index();
            $table->unsignedBigInteger('form_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();
            $table->foreign('customer_id')
                  ->references('id')->on('customers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('taxonomy_id')
                  ->references('id')->on('taxonomies')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('form_id')
                  ->references('id')->on('forms')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formulas');
    }
}
