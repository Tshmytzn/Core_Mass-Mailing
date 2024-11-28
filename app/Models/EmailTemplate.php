<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Guid\Guid; // Import the Ramsey UUID generator
class EmailTemplate extends Model
{
    use HasFactory;

    // Define the table name explicitly
    protected $table = 'email_template';

    // Use UUIDs instead of incrementing integers
    public $incrementing = false;
    protected $keyType = 'string';

    // Specify the primary key
    protected $primaryKey = 'temp_id';

    // Fields that can be mass-assigned
    protected $fillable = [
        'acc_id',
        'temp_subject',
        'temp_body',
        'temp_type',
        'temp_followup',
    ];

    // Cast timestamps to datetime objects
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Automatically generate UUID for acc_id if not provided
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate a UUID for acc_id before creating
            if (!$model->temp_id) {
                $model->temp_id = (string) Guid::uuid4();
            }
        });
    }
}
