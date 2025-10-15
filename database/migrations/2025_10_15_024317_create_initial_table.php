<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * PRODUCTS TABLE
         */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price')->unsigned();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * SCHEDULES TABLE
         */
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->dateTime('date');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * BOOKINGS TABLE
         */
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();

            $table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('product_name');
            $table->integer('product_price')->unsigned();

            $table->foreignId('schedule_id')->constrained('schedules')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('schedule_place');
            $table->string('schedule_date');

            $table->enum('status', ['pending', 'paid', 'done', 'cancelled'])->default('pending');

            // Identitas pengguna (plaintext)
            $table->string('full_name', 255);
            $table->string('nik', 32)->index();
            $table->string('passport_number', 64)->index();
            $table->text('passport_file');

            $table->date('dob');
            $table->enum('gender', ['M', 'F']);
            $table->string('phone', 32);
            $table->string('email', 255);
            $table->boolean('is_vaccinated')->default(false);

            $table->text('vaccine_certificate_file')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('products');
    }
};
