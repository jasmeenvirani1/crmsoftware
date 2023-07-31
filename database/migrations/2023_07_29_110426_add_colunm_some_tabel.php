<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunmSomeTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('merchant_categories', function (Blueprint $table) {
        //     $table->string('group_id')->nullable()->after('images');
        // });
        // Schema::table('vendor', function (Blueprint $table) {
        //     $table->string('group_id')->nullable()->after('vendor_company_pincode');
        // });
        // Schema::table('quotation', function (Blueprint $table) {
        //     $table->string('group_id')->nullable()->after('prepared_by');
        // });
        // Schema::table('stock_management', function (Blueprint $table) {
        //     $table->string('group_id')->nullable()->after('notes');
        // });
        Schema::table('customer', function (Blueprint $table) {
            $table->string('group_id')->nullable()->after('cheque');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('merchant_categories', function (Blueprint $table) {
        //     $table->dropColumn('group_id');
        // });
        // Schema::table('vendor', function (Blueprint $table) {
        //     $table->dropColumn('group_id');
        // });
        // Schema::table('quotation', function (Blueprint $table) {
        //     $table->dropColumn('group_id');
        // });
        // Schema::table('stock_management', function (Blueprint $table) {
        //     $table->dropColumn('group_id');
        // });
        Schema::table('customer', function (Blueprint $table) {
            $table->dropColumn('group_id');
        });
    }
}
