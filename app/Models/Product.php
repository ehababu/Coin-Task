<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'keywords' => 'array'
    ];

    public function getActiveStatusAttribute() {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getKeywordsAsStringAttribute() {
        $keywords_str = '';
        for($i = 0; $i < count($this->keywords); $i++) {
            if($i == count($this->keywords) - 1) {
                $keywords_str.=$this->keywords[$i];
                break;
            } else {
                $keywords_str.=$this->keywords[$i] . ',';
            }
        }
        return $keywords_str;
    }

}