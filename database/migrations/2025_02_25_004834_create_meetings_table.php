<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('assistant_id');

            $table->dateTime('dateTime');
            $table->text('notes')->nullable();
            $table->enum('status', ['Pending', 'Accept', 'Reject', 'Rescheduled', 'Attended'])->default('Pending');

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('assistant_id')->references('id')->on('assistants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
