<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteSomeColunm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotation', function (Blueprint $table) {
            $table->dropColumn('personname');
            $table->dropColumn('phonenumber');
            $table->dropColumn('email');
        });
        Schema::table('stock_management', function (Blueprint $table) {
            $table->dropColumn('images');
            $table->dropColumn('vendorimage');
            $table->dropColumn('clientimage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotation', function (Blueprint $table) {
            $table->string('personname');
            $table->string('phonenumber');
            $table->string('email');
        });
        Schema::table('stock_management', function (Blueprint $table) {
            $table->string('images');
            $table->string('vendorimage');
            $table->string('clientimage');
        });
    }
}
