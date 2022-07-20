<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getActiveStatusAttribute() {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function getproduct(){
        return $this->belongsTo(Category::class, 'cat', 'id');

    }

}
