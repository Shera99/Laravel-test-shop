<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

//    public function getCategory()
//    {
//        return Category::find($this->category_id);
//    }

/*
 * Возврашает категорию с которой связан данный товар
 */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount($count)
    {
        if (!is_null($count)) {
            return $this->price * $count;
        }
        return $this->price;
    }
}
