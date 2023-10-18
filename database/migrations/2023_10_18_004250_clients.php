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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->char('name', 100);
            $table->char('email', 100);
            $table->char('phone', 12);
            $table->date('date_of_birth');
            $table->char('address', 100);
            $table->char('complement', 50);
            $table->char('district', 100);
            $table->char('zip_code', 9);
            $table->date('registration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('clients');
    }
};
