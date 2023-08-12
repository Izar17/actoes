<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductQtyUnitPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('asset_products') && !Schema::hasColumn('asset_products', 'qty')) {
            Schema::table('asset_products', function (Blueprint $table) {
                $table->string('qty')->default(0);
            });
        }
            if (Schema::hasTable('asset_products') && !Schema::hasColumn('asset_products', 'unit')) {
                Schema::table('asset_products', function (Blueprint $table) {
                    $table->string('unit')->default(0);
                });
            }
                if (Schema::hasTable('asset_products') && !Schema::hasColumn('asset_products', 'price')) {
                    Schema::table('asset_products', function (Blueprint $table) {
                        $table->string('price')->default(0);
                    });
    }
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
