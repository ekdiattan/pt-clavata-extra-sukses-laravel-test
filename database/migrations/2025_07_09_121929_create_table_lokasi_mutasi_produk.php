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
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_lokasi');
            $table->string('nama_lokasi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis_mutasi');
            $table->string('jumlah');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('kode_produk');
            $table->string('kategori');
            $table->string('satuan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
        Schema::dropIfExists('lokasi');
        Schema::dropIfExists('mutasi');
    }
};
