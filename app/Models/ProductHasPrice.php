<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHasPrice extends Model
{
    use HasFactory;

    protected $table = 'product_has_price';
    protected $fillable=[  'product_id', 'price'];

    public function price(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
