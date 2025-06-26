<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id');
            $table->string('title');
            $table->string('intervenant');
            $table->text('description');
            $table->dateTime('datetime');
            $table->string('location');
            $table->string('poster')->nullable();
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->boolean('certificated')->default(false);
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};