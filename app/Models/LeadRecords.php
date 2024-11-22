<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LeadRecords extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'leads_record';

    // Primary key
    protected $primaryKey = 'lead_id';

    // Disabling auto-incrementing since we're using UUIDs
    public $incrementing = false;

    // Fillable fields
    protected $fillable = [
        'acc_id',
        'lead_firstname',
        'lead_lastname',
        'lead_email',
        'lead_company',
        'lead_number',
        'lead_type',
        'lead_status',
        'lead_dnc',
    ];

    // Mutators or setters (if necessary for custom logic)
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a UUID for lead_id if it’s not set
        static::creating(function ($model) {
            if (!$model->lead_id) {
                $model->lead_id = (string) Str::uuid();
            }
        });
    }
}
