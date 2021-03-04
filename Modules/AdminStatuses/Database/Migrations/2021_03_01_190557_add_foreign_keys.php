<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->foreign('status_type_id')->references('id')->on('status_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('status_category_id')->references('id')->on('status_categories')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->dropForeign('statuses_status_type_id_foreign');
            $table->dropForeign('statuses_status_category_id_foreign');
        });
    }
}
