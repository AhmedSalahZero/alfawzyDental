<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function author(){
        return $this->belongsTo(Author::class,'author_id');
    }

    public function category(){
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }


}
