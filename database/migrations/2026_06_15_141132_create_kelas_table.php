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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('pengajar_id')
                ->constrained('pengajars')
                ->cascadeOnDelete();
        
            $table->string('nama_kelas');
            $table->text('deskripsi')->nullable();
        
            $table->decimal('harga', 12, 2);
        
            $table->integer('kuota');
        
            $table->enum('status', [
                'aktif',
                'nonaktif'
            ])->default('aktif');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
