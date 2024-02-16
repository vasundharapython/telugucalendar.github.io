<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class SthothraluSubCategory extends Model
{
    use SoftDeletes, HasFactory;
    use Sluggable;

    public $table = 'sthothralu_sub_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'subcategory_id',
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function categorySthotralus()
    {
        return $this->hasMany(Sthotralu::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SthotraluCategory::class, 'subcategory_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category'
            ]
        ];
    }
}
