<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMember extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function members(){
        return $this->hasMany(Member::class,'category_member_id');
    }


}
