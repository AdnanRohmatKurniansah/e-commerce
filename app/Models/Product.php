<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function scopeFilter($query, array $filters) 
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                 $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('desc', 'like', '%' . $search . '%');
             });
         }); 
    }
}
