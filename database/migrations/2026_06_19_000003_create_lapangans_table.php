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
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // Soccer, Futsal
            $table->string('surface'); // Sintetis, Rumput Alami
            $table->integer('price_per_hour');
            $table->string('location');
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->string('status')->default('active'); // active, inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapangans');
    }
};
