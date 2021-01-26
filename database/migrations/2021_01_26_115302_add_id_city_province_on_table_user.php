<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCityProvinceOnTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->integer('sales_id')->nullable()->after('stock');
            $table->integer('city_id')->nullable()->after('stock');
            $table->integer('province_id')->nullable();
            $table->integer('low_stock_treshold')->default(0)->unsigned()->after('stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
