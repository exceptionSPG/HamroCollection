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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('municipal_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('post_code')->nullable();
            $table->text('ward_no');
            $table->string('payment_type')->nullable();
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->string('currency')->default('npr');;
            $table->float('amount', 8, 2);
            $table->string('order_number')->nullable();
            $table->string('invoice_number');
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->string('confirmed_date')->nullable();
            $table->string('processing_date')->nullable();
            $table->string('picked_date')->nullable();
            $table->string('shipped_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_reason')->nullable();
            $table->string('esewa_status')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
};
