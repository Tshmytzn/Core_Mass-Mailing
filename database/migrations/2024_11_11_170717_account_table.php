<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // For data insertion
use Illuminate\Support\Facades\Hash; // For password hashing
use Ramsey\Uuid\Guid\Guid; // Import the Ramsey UUID generator

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Account', function (Blueprint $table) {
            $table->uuid('acc_id')->primary(); // Use UUID as primary key
            $table->string('acc_username')->nullable();
            $table->string('acc_email')->nullable();
            $table->string('acc_password')->nullable();
            $table->string('acc_company_id')->nullable();
            $table->string('acc_type')->nullable();
            $table->string('acc_pic')->nullable();
            $table->timestamps();
        });

        // Insert default record with a UUID for acc_id
        DB::table('Account')->insert([
            [
                'acc_id' => (string) Guid::uuid4(), // Generate UUID
                'acc_username' => 'Admin',
                'acc_company_id' => '000000001',
                'acc_email' => 'Admin',
                'acc_password' => Hash::make('Admin'),
                'acc_type' => 'Admin',
                'acc_pic' => 'default_pic.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('Account');
    }
};
