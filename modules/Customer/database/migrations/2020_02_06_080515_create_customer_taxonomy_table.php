<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_taxonomy', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('taxonomy_id')->index();
            $table->foreign('customer_id')
                  ->references('id')->on('customers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('taxonomy_id')
                  ->references('id')->on('taxonomies')
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
        Schema::dropIfExists('customer_taxonomy');
    }
}
