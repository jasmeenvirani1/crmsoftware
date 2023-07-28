<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInwardQuantityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inward_quantity', function (Blueprint $table) {
            $table->id();
            $table->string('stock_id');
            $table->string('inward_qty');
            $table->string('vendor_name');
            $table->string('outward_qty');
            $table->string('lpm_no');
            $table->string('project_name');
            $table->string('notes');
            $table->string('balanced_qty');
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
        Schema::dropIfExists('inward_quantity');
    }
}
