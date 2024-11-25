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
        Schema::create('mail_record', callback: function (Blueprint $table) {
            $table->uuid('mr_id')->primary(); // Use UUID as primary key
            $table->string('acc_id')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('mr_type')->nullable();
            $table->string('mr_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_record');
    }
};
