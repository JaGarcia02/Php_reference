<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Model extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        "product_name",
        "price",
        "cat_id",
        "sup_id",
    ];

}
