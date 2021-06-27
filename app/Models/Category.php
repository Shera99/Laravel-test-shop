<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /*
     * Возврашает все продукты относяшиесия к определенной категории
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
