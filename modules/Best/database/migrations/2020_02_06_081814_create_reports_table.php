<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->index();
            $table->longtext('value')->nullable();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('form_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();
            $table->foreign('customer_id')
                  ->references('id')->on('customers')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('form_id')
                  ->references('id')->on('forms')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
