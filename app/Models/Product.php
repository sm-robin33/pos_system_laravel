<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[ 'name', 'brand_id', 'barcode', 'category_id', 'subcategory_id', 'product_image', 'measure_purchase_id', 'measure_sale_id','discount_id', 'status','created_by', 'updated_by'   

    ];

    public function brands(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function subcategory(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(SubCategories::class, 'id', 'subcategory_id');
    }

    public function purchaseMeasurement(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(Measurement::class, 'id', 'measure_purchase_id');
    }

    public function saleMeasurement(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(Measurement::class, 'id', 'measure_sale_id');
    }

    public function Discount(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(DiscountPolicy::class, 'id', 'discount_id');
    }

    public function ProductPrice(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(ProductHasPrice::class, 'product_id', 'id');
    }

    
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

   
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    public static $statusArrays = ['active', 'inactive'];
}
