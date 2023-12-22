<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Inventory extends Model
{
    use HasFactory;

    public static $statusArrays = ['inactive', 'active'];

    protected $fillable = ['product_id', 'category_id','sub-category_id','brand_id','store_id','quantity', 'created_by', 'updated_by'];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }

    public function category_parent(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function product_parent(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function brand_parent(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
    public function store_parent(): HasOne
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
    // public function quantity(): HasOne
    // {
    //     return $this->hasOne(Category::class, 'id', 'quantity');
    // }
}
