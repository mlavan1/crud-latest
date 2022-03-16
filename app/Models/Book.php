<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'id',
        'book_name',
        'price',
        'author'
    ];

    protected $table="books";

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    
}
