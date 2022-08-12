<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'brand', 'model', 'serial_number', 'tags',
        'disposition', 'status', 'user_id', 'department_id', 'location_id',
        'category_id', 'functionality', 'note', 'others', 'image', 'staff'
    ];

    protected $casts = [
        'others' => 'array',
        'staff' => 'array',
        'tags' => 'array'
    ];

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'assets_staffs', 'asset_id', 'staff_id');
    }
}
