<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getActiveStatusAttribute() {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function products(){
        return $this->hasMany(Product::class);

    }
}
