<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','sku','category_id','purchase_price','sell_price','stock_min','stock_current','unit','location','image'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
