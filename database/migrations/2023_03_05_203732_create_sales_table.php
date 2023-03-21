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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 10,2);
            $table->integer('items');
            $table->decimal('cash',10,2);
            $table->decimal('change',10,2);
            $table->decimal('discount',10,2);
            $table->enum('status', ['PAID', 'PENDING', 'CANCELLED'])->default('PAID');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            //$table->unsignedBigInteger('customer_id');
            //$table->foreign('customer_id')->references('id')->on('customers');


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
        Schema::dropIfExists('sales');
    }
};
