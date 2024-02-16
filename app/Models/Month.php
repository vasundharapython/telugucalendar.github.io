<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;

class Month extends Model
{
    use SoftDeletes, HasFactory;
    use Sluggable;

    public $table = 'months';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'month_id',
        'date',
        'heading',
        'pandugalu',
        'govtselavu',
        'upavasalu',
        'importantdays',
        'created_at',
        'updated_at',
        'deleted_at',
    ];



    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function month()
    {
        return $this->belongsTo(Nelalu::class, 'month_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }




    public function getFormattedMonthAttribute()
    {
        $date = is_string($this->date) ? Carbon::parse($this->date) : $this->date;
        // Assuming 'date' is a Carbon instance
        return $date ? $date->format('F') : null; // 'F' gives the full month name
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'formatted_month'
            ]
        ];
    }
}
