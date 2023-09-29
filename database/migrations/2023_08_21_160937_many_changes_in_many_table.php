<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManyChangesInManyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_management', function (Blueprint $table) {
            $table->string('retail_price')->nullable()->after('notes');
            $table->string('dealer_price')->nullable()->after('notes');
            $table->string('corporate_price')->nullable()->after('notes');
            $table->string('minimum_order_quantity')->nullable()->after('notes');
        });

        Schema::table('quotation', function (Blueprint $table) {

            $table->string('billing_address_longitude')->nullable()->after('prepared_by');
            $table->string('billing_address_latitude')->nullable()->after('prepared_by');
            $table->string('billing_address')->nullable()->after('prepared_by');

            $table->string('plant_address_longitude')->nullable()->after('prepared_by');
            $table->string('plant_address_latitude')->nullable()->after('prepared_by');
            $table->string('plant_address')->nullable()->after('prepared_by');

            $table->string('registered_address_longitude')->nullable()->after('prepared_by');
            $table->string('registered_address_latitude')->nullable()->after('prepared_by');
            $table->text('registered_address')->nullable()->after('prepared_by');
        });

        Schema::table('quotation_details', function (Blueprint $table) {
            $table->string('designation')->nullable()->after('phone');
        });

        Schema::table('customer', function (Blueprint $table) {
            $table->text('notes')->nullable();
        });

        Schema::create('customer_extra_images', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('stock_vendors', function (Blueprint $table) {
            $table->string('price')->nullable()->after('quotation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
