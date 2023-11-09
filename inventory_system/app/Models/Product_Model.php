<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category_Model;
use App\Models\Supplier_Model;

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

    public function categories(){
        return $this->belongsTo(Category_Model::class, 'cat_id');
    }
    
    public function suppliers(){
        return $this->belongsTo(Supplier_Model::class, 'sup_id');
    }
    

}
