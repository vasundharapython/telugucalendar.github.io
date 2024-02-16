<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class SsubCategory extends Model
{
    use SoftDeletes, HasFactory;
    use Sluggable;

    public $table = 'ssub_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'scategory_id',
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function ssubcategorySthothraluCopies()
    {
        return $this->hasMany(SthothraluCopy::class, 'ssubcategory_id', 'id');
    }

    public function scategory()
    {
        return $this->belongsTo(Scategory::class, 'scategory_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
