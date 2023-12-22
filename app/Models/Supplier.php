<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable=[ 'supplier_name', 'phone', 'brand_id', 'email', 'address', 'status',  'created_by', 'updated_by'

    ];

    public static $statusArrays = ['inactive', 'active'];

    protected $casts = [
        'email_verified_at' => 'datetime',
      ];

    public function brand_parent(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}
