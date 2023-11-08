<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_Model extends Model
{
    use HasFactory;

    protected $table = "suppliers";

    protected $fillable = [
        "supplier_name",
        "contact_num",
        "address",
    ];
}
