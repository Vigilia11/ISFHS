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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->string('type');
            $table->string('name');
            $table->string('status');
            $table->longText('street');
            $table->longText('barangay');
            $table->longText('city');
            $table->longText('province');
            $table->binary('facility_picture');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
