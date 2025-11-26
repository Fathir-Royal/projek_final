<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['transaction_number','type','created_by','status','notes'];
    public function items() {
        return $this->hasMany(TransactionItem::class);
    }
}
