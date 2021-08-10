<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('first_name')->nullable();
            $table->string('address')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('zip')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('first_name');
            $table->dropColumn('address');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('zip');
            $table->dropColumn('email');

        });
    }
}
