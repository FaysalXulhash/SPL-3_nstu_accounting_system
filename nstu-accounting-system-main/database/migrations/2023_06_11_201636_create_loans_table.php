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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('application_id');

            $table->integer('current_salary_scale');
            $table->integer('basic_salary_scale');
            $table->integer('amount');
            $table->integer('accepted_amount')->nullable();
            $table->string('reason');
            $table->string('repay_method');
            $table->string('payment_status')->nullable(); // paid, not_paid // Office provided loan
            $table->string('repayment_status')->nullable(); // paid, not_paid
            $table->date('payment_deadline')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('repaid_at')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('application_id')->references('id')->on('applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
