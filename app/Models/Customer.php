<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id', 'name',  'phone', 'email', 'address', 'password', 'gender', 'status', 'created_by', 'updated_by'
    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
      return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

   
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static $minimumPasswordLength = 8;
  public static $genderArrays = ['male', 'female'];
  public static $statusArrays = ['active', 'inactive'];
}
