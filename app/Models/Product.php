<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =['title', 'description', 'quantity', 'price', 'discount_price'];

    public function category()
    {
       return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
