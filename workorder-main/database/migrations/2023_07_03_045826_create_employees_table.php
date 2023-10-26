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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nrp',12);
            $table->string('name',40);
            $table->string('email',50)->unique();
            $table->string('no_handphone',15);
            $table->date('date_born');
            $table->text('address');
            $table->string('password',255);
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->foreignId('company_id')->nullable()->constrained('companies');
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
        Schema::dropIfExists('employees');
    }
};
