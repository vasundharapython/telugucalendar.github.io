<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Nelalu extends Model
{
    use SoftDeletes, HasFactory;
    use Sluggable;

    public $table = 'nelalus';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'month',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function monthMuhurthalus()
    {
        return $this->hasMany(Muhurthalu::class, 'month_id', 'id');
    }

    public function monthMonths()
    {
        return $this->hasMany(Month::class, 'month_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'month'
            ]
        ];
    }
}
