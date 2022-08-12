<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventorie;
use App\Models\inventoryproduct;
use App\Models\product;
use App\Models\customer;

class inventorieController extends Controller
{

    public function addInventories(){
        $getCustomers = customer::orderby("id","DESC")->get();
        $getProducts = product::orderby("name","ASC")->get();
        return view("inventories", compact('getCustomers','getProducts'));
    }

    public function findBill(){
        $getCustomers = customer::orderby("id","DESC")->get();
        $getProducts = product::orderby("name","ASC")->get();

        $getinventorie = inventorie::get();

        return view("findBill", compact('getCustomers','getProducts','getinventorie'));
    }

    public function billNoSearch(Request $req){
       
       $count       = inventorie::where("billNo",$req->find)->count();
       $inventor    = inventorie::where("billNo",$req->find)->first();

       if ($count > 0) {

        $inventoryproduct = inventoryproduct::where("inventoryId",$inventor->id)->get();
       $table = "";
       foreach($inventoryproduct as $data){

            $TotalAmount    = $data['rate'] * $data['qty'];
            $NetAmout       = $TotalAmount - $data['discount'];

           $table .= '<tr><td>'.$data->product['name'].'</td>';
           $table .= '<td id="rate_'.$data->product['id'].'">'.$data['rate'].'</td>';

           $table .= '<td><input type="hidden" value="'.$data->product['id'].'" name="productId[]"><input type="hidden" value="'.$data['id'].'" name="inventoryproductid[]"><input type="hidden" value="'.$data['rate'].'" name="rate[]"><input type="number" min="1" onchange="singleRowCal('.$data->product['id'].')" class="form-control" id="qty_'.$data->product['id'].'" name="qty[]" value="'.$data['qty'].'"></td>';

           $table .= '<td id="totalAmount_'.$data->product['id'].'">'.$TotalAmount.'</td>';

           $table .= '<td><input type="number" min="0" onchange="singleRowCal('.$data->product['id'].')" class="form-control discountAmount" name="discount[]" id="discount_'.$data->product['id'].'" value="'.$data['discount'].'"></td>';
           $table .= '<td id="netmsg_'.$data->product['id'].'" class="netAmount">'.$NetAmout.'</td></tr>';

       }

           return response()->json([
            "status" => 1,
            "message" => $inventor,
            "customer" => $inventor->customer,
            "table" => $table
            ]);
       }else{
            return response()->json(["status" => 0]);
       }

    }


    public function inventorieInsert(Request $req){
        $bill = strtoupper(substr(md5(time()),0,5));
        $inven = new inventorie();
        $inven->date = $req->date;
        $inven->billNo  = $bill;
        $inven->customerId = $req->customerId;
        $inven->totalDiscount = $req->totalDiscount;
        $inven->totalBillAmount = $req->totalBillAmount;
        $inven->dueAmount = $req->dueAmount;
        $inven->paidAmount = $req->paidAmount;
        $inven->save();

        for ($i=0; $i < count($req->productId) ; $i++) { 
            $invenPro = new inventoryproduct();
            $invenPro->inventoryId = $inven->id;
            $invenPro->productId = $req->productId[$i];
            $invenPro->rate = $req->rate[$i];
            $invenPro->qty = $req->qty[$i];
            $invenPro->discount = $req->discount[$i];
            $invenPro->save();
        }

        return response()->json(['status' => 0]);
    }

    public function inventorieUpdate(Request $req){

        $inven = inventorie::findorFail($req->invenId);
        $inven->date = $req->date;
        $inven->customerId = $req->customerId;
        $inven->totalDiscount = $req->totalDiscount;
        $inven->totalBillAmount = $req->totalBillAmount;
        $inven->dueAmount = $req->dueAmount;
        $inven->paidAmount = $req->paidAmount;
        $inven->save();

        for ($i=0; $i < count($req->productId) ; $i++) {
            $invenPro = inventoryproduct::find($req->inventoryproductid[$i]);
            $invenPro->productId = $req->productId[$i];
            $invenPro->rate = $req->rate[$i];
            $invenPro->qty = $req->qty[$i];
            $invenPro->discount = $req->discount[$i];
            $invenPro->save();
        }
        
        return response()->json(['status' => 0]);
    }




}
