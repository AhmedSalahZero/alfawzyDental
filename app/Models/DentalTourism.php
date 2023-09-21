<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentalTourism extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function images(){
        return $this->hasMany(DentalTourismImage::class,'dental_tourism_id');
    }
    public function rows(){
        return $this->hasMany(DentalTourismRow::class,'dental_tourism_id');
    }
}
