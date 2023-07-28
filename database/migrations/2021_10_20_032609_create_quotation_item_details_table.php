<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_item_details', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_id');
            $table->string('i_d_height');
            $table->string('i_d_width');
            $table->string('i_d_depth');
            $table->string('e_d_height');
            $table->string('e_d_width');
            $table->string('e_d_depth');
            $table->string('h_s_code');
            $table->string('unit_price');
            $table->string('quantity');
            $table->string('total_price');
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
        Schema::dropIfExists('quotation_item_details');
    }
}
