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
        Schema::create('quality_checks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->restrictOnDelete();

            $table->foreignId('checked_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->decimal('moisture_percentage', 5, 2)->nullable();
            $table->decimal('fermentation_percentage', 5, 2)->nullable();
            $table->decimal('defective_beans_percentage', 5, 2)
                ->nullable();

            $table->enum('quality_result', [
                'passed',
                'failed',
                'pending',
            ])->default('pending');

            $table->text('notes')->nullable();
            $table->dateTime('checked_at')->nullable();

            $table->timestamps();

            $table->index(['batch_id', 'quality_result']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_checks');
    }
};
