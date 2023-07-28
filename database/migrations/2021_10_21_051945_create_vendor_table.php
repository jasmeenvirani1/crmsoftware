<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('vendor_company_name');
            $table->string('vendor_email_id');
            $table->string('vendor_gst_no');
            $table->string('vendor_contact_no');
            $table->string('vendor_company_address');
            $table->string('vendor_company_country');
            $table->string('vendor_company_state');
            $table->string('vendor_company_city');
            $table->string('vendor_company_pincode');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('vendor');
    }
}
