<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SignatureModel extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'signature';

    // Define the primary key for the table (UUID)
    protected $primaryKey = 'sig_id';

    // Disable auto-increment since we're using UUIDs
    public $incrementing = false;

    // Set the key type to UUID
    protected $keyType = 'string';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'acc_id',
        'sig_body'
    ];

    // Automatically generate UUIDs when a new signature is created
    protected static function boot()
    {
        parent::boot();

        // Create a UUID for the sig_id attribute when a new model instance is created
        static::creating(function ($signature): void {
            if (!$signature->sig_id) {
                $signature->sig_id = (string) Str::uuid(); // Generate UUID
            }
        });
    }
}
