<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportRating extends Model
{
    use HasFactory;

    protected $table = 'report_ratings';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'laporan_id', 
        'user_id', 
        'rating_type'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'laporan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
