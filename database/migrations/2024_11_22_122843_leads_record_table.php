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
        Schema::create('leads_record', callback: function (Blueprint $table) {
            $table->uuid('lead_id')->primary(); // Use UUID as primary key
            $table->string('acc_id')->nullable();
            $table->string('lead_firstname')->nullable();
            $table->string('lead_lastname')->nullable();
            $table->string('lead_email')->nullable();
            $table->string('lead_company')->nullable();
            $table->string('lead_number')->nullable();
            $table->string('lead_type')->nullable();
            $table->string('lead_status')->nullable();
            $table->string('lead_dnc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_record');
    }
};
