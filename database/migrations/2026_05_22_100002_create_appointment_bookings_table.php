<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_bookings', function (Blueprint $table) {
            $table->id();
            $table->date('appointment_date');
            $table->foreignId('appointment_time_slot_id')->constrained('appointment_time_slots')->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone', 40)->nullable();
            $table->string('customer_email');
            $table->text('notes')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamps();

            $table->index(['appointment_date', 'appointment_time_slot_id', 'status'], 'appt_bookings_date_slot_status_idx');
            $table->index(['appointment_date', 'status'], 'appt_bookings_date_status_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_bookings');
    }
};
