<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastModifiedByFieldInSdmiIndexScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smdi_index_scores', function (Blueprint $table) {
            $table->string('last_modified_by')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smdi_index_scores', function (Blueprint $table) {
            $table->dropColumn('last_modified_by');
        });
    }
}
