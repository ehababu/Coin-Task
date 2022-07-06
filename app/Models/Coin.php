<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

        public function getActiveStatusAttribute() {
            return $this->is_active ? 'Active' : 'Inactive';
        }

        public function getVirtualStatusAttribute() {
            return $this->is_virtual ? 'True' : 'False';
        }
}
