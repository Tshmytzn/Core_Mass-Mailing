<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Guid\Guid; // Import the Ramsey UUID generator

class AccountModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'account';

    // Use UUID for the primary key
    protected $primaryKey = 'acc_id';

    // Disable auto-incrementing
    public $incrementing = false;

    // Define the key type as string (UUIDs are strings)
    protected $keyType = 'string';

    protected $fillable = [
        'acc_username',
        'acc_fullname',
        'acc_email',
        'acc_password',
        'acc_company_id',
        'acc_type',
        'acc_pic',
    ];

    protected $hidden = [
        'acc_password',
    ];

    // Automatically generate UUID on create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate a UUID for acc_id before creating
            if (!$model->acc_id) {
                $model->acc_id = (string) Guid::uuid4();
            }
        });
    }
}
