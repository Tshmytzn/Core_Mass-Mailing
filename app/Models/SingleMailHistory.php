<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SingleMailHistory extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'single_mail_history';

    // Use UUID as primary key instead of auto-incrementing ID
    protected $primaryKey = 'smh_id';
    public $incrementing = false; // Disable auto-incrementing since we are using UUID

    // Specify the data type for the primary key
    protected $keyType = 'string';

    // Mass assignable attributes
    protected $fillable = [
        'acc_id',
        'smh_mailto',
        'smh_content',
        'smh_date',
        'smh_type',
    ];

    // Optionally, specify any attributes to be cast to native types
    protected $casts = [
        'smh_date' => 'datetime', // Convert `smh_date` to a datetime object
    ];

    protected static function boot()
    {
        parent::boot();

        // Create a UUID for the smh_id attribute when a new model instance is created
        static::creating(function ($singleMailHistory) {
            if (!$singleMailHistory->smh_id) {
                $singleMailHistory->smh_id = (string) Str::uuid(); // Generate UUID
            }
        });
    }
}
