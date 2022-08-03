<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'description', 'status', 'asset_id', 'service_type', 'staff_id', 'serviced_by',
        'repaired_at', 'comment', 'priority', 'image'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
