<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubCategories extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category', 'created_by', 'updated_by'];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }

    public function subcategory_parent(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
}
