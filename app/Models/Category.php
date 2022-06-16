<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'properties'
    ];

    protected $casts = [
        'properties' => 'array'
    ];

    public function setPropertiesAttribute($value)
    {
        $properties = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $properties[] = $array_item;
            }
        }

        $this->attributes['properties'] = json_encode($properties);
    }

    public function asset()
    {
        return $this->hasMany(Asset::class);
    }
}
