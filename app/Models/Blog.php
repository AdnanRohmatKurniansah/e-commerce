<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function blogCategory() {
        return $this->belongsTo(BlogCategory::class, 'blogCategory_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function scopeFilter($query, array $filters) 
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                 $query->where('title', 'like', '%' . $search . '%')
                             ->orWhere('body', 'like', '%' . $search . '%');
             });
         }); 
         
        $query->when($filters['blogCategory'] ?? false, function($query, $blogCategory) {
            return $query->whereHas('blogCategory', function($query) use ($blogCategory) {
                 $query->where('slug' , $blogCategory);
             });
         });  
    }

}
