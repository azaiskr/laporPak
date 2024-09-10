<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status'
    ];

    public function reports(){
        return $this->hasMany(Report::class,'status','id');
    }
}
