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
        Schema::create('signature', callback: function (Blueprint $table) {
            $table->uuid('sig_id')->primary(); // Use UUID as primary key
            $table->string('acc_id')->nullable();
            $table->longText('sig_body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signature');
    }
};
