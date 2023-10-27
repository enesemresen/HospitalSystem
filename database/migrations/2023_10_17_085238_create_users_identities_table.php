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
        Schema::create('user_identities', function (Blueprint $table) {
            $table->id();
            $table->string('tc_no');
            $table->string('mother_name');
            $table->string('father_name');
            $table->string('serial_no');
            $table->string('birthday');
            $table->string('birthplace');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string("insurance_number");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_identities');
    }
};
