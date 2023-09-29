<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefultColunmCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->enum('default', ['0', '1'])->after('group_id')->nullable();
            $table->string('logo')->after('gst')->nullable();
            $table->string('msme_certificate')->after('pancard')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropIfExists('default');
            $table->dropIfExists('logo');
            $table->dropIfExists('msme_certificate');
        });
    }
}
