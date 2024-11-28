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
       Schema::create('email_template', callback: function (Blueprint $table) {
            $table->uuid('temp_id')->primary(); // Use UUID as primary key
            $table->string('acc_id')->nullable();
            $table->string('temp_subject')->nullable();
            $table->longText('temp_body')->nullable();
            $table->string('temp_followup')->nullable()->default('false');
            $table->string('temp_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_template');
    }
};
