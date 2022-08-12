<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventorie extends Model
{
    use HasFactory;
    protected $table = "inventories";
    protected $fillable = [
        "date",
        "billNo",
        "customerId",
        "totalDiscount",
        "totalBillAmount",
        "dueAmount",
        "paidAmount"
    ];
    protected $primaryKey = "id";
    public $timestamps = true;

    public function customer(){
        return $this->belongsTo(customer::class,'customerId');
    }


}