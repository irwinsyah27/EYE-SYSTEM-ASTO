<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('item',25);
            $table->integer('qty');
            $table->string('image',200)->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('final_date')->nullable();
            $table->integer('hours_use')->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('units')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('workorder_id')->nullable()->constrained('work_orders')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('work_order_details');
    }
};
