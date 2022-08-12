<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventoryproduct extends Model
{
    use HasFactory;
    protected $table = "inventoryproducts";
    protected $fillable = [
        "inventoryId",
        "productId",
        "rate",
        "qty",
        "discount"
    ];
    protected $primaryKey = "id";
    public $timestamps = true;

    public function product(){
        return $this->belongsTo(product::class,'productId');
    }


}
