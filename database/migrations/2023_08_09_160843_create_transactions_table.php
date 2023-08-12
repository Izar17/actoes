<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rx_no')->nullable();
            $table->integer('count')->nullable(); 
            $table->string('hospital_id')->nullable(); 
            $table->string('item')->nullable(); 
            $table->string('lead_pot')->nullable(); 
            $table->string('unit')->nullable(); 
            $table->string('particular')->nullable(); 
            $table->string('activity_mci')->nullable(); 
            $table->string('activity_mbq')->nullable(); 
            $table->string('patient')->nullable(); 
            $table->string('calibration_date')->nullable(); 
            $table->string('lot_no')->nullable(); 
            $table->string('remarks')->nullable(); 
            $table->string('10_percent')->nullable(); 
            $table->string('actual_dose')->nullable(); 
            $table->string('dr_no')->nullable(); 
            $table->string('invoice_no')->nullable(); 
            $table->string('date_time')->nullable(); 
            $table->string('date2')->nullable(); 
            $table->string('view_link')->nullable(); 
            $table->string('edit_link')->nullable(); 
            $table->string('created_by')->nullable(); 
            $table->string('cancelled')->nullable(); 
            $table->string('orderform_no')->nullable(); 
            $table->string('order_no')->nullable(); 
            $table->string('date_ordered')->nullable(); 
            $table->string('asset_id')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
