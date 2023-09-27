<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function services(){
        return $this->hasMany(Service::class,'category_service_id')->orderBy('ranking','ASC')->where('is_special',false);
    }
}
