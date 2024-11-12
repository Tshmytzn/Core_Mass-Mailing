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
        Schema::create('single_mail_history', callback: function (Blueprint $table) {
            $table->uuid('smh_id')->primary(); // Use UUID as primary key
            $table->string('acc_id')->nullable();
            $table->string('smh_mailto')->nullable();
            $table->string('smh_content')->nullable();
            $table->string('smh_date')->nullable();
            $table->string('smh_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('single_mail_history');
    }
};
