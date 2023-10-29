<?php

use App\Enums\ServiceEstimatedTimeUnit;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('outlet_id');
            $table->foreignId('service_type_id');
            $table->string('name', 255);
            $table->double('price');
            $table->string('description', 255)->nullable();
            $table->string('image')->nullable();
            $table->double('estimated_time')->default(0);
            $table->enum('estimated_time_unit', array_column(ServiceEstimatedTimeUnit::cases(), 'value'))->default(ServiceEstimatedTimeUnit::Minutes->value);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
