<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets_staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id', 'asset_id'
    ];
}
