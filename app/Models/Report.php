<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'description',
        'media',
        'latitude',
        'longitude',
        'address',
        'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function ratings()
    {
        return $this->hasMany(ReportRating::class, 'id', 'id');
    }

    public function getUpRateAttribute()
    {
        return $this->ratings()->where('rating_type', 'up')->count();
    }

    public function getDownRateAttribute()
    {
        return $this->ratings()->where('rating_type', 'down')->count();
    }
}
