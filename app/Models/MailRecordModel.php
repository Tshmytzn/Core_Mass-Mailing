<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MailRecordModel extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'mail_record';

    // Set the primary key
    protected $primaryKey = 'mr_id';

    // Use a non-incrementing or non-numeric primary key
    public $incrementing = false;

    // Set the primary key data type
    protected $keyType = 'string';

    // Define fillable fields
    protected $fillable = [
        'acc_id',
        'mr_mailto',
        'mr_name',
        'mr_company',
        'mr_type',
        'mr_status',
        'mr_send_count'
    ];

    // Specify date fields for Carbon casting
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Boot method to generate UUID for mr_id before creating a new record.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate a UUID for mr_id if it’s not set
            if (!$model->mr_id) {
                $model->mr_id = (string) Str::uuid();
            }
        });
    }
}
