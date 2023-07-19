<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('orders', function (Blueprint $table) {
                $table->id()->startingValue(51);
                $table->string('resi')->nullable();
                $table->string('fname');
                $table->string('lname');
                $table->string('pnumber');
                $table->string('email');
                $table->string('province');
                $table->string('regency');
                $table->string('district');
                $table->text('street');
                $table->string('zip');
                $table->string('note');
                $table->string('courier');
                $table->string('service');
                $table->integer('shipping_cost');
                $table->integer('sub_total');
                $table->integer('total');
                $table->string('status')->default('unpaid');
                $table->text('snaptoken')->nullable();


                $table->foreignId('user_id');
                $table->timestamps();
                $table->timestamp('due_date');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
