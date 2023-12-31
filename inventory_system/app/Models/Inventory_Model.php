<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_Model;

class Inventory_Model extends Model
{
    use HasFactory;

    protected $table = "inventories";

    protected $fillable = [
        "product_id",
        "stock",
    ];

    public function products(){
        return $this->belongsTo(Product_Model::class, 'product_id');
    }

}
