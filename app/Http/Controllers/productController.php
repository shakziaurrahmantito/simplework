<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function productAdd(){
        return view("productAdd");
    }

    public function productInsert(Request $req){

        $valid = Validator::make($req->all(),[
            "code" => "required",
            "name" => "required",
            "rate" => "required"
        ]);

        if ($valid->fails()) {
            return response()->json(["status" => 0, "message" => $valid->errors()]);
        }

        $pro = new product();
        $pro->code = $req->code;
        $pro->name = $req->name;
        $pro->rate = $req->rate;
        $pro->save();
        return response()->json(["status" => 1, "message" => "Product added successfully!"]);
    }

    public function productlist(){
        $getproduct = product::orderby("id","DESC")->get();
        return view("productlist", compact('getproduct'));
    }

    public function proDel($id){
        $getproduct = product::findorFail($id)->delete();
        return redirect("/productlist");
    }

    public function proEdit($id){
        $getSingleDataProduct = product::findorFail($id);
        return view("productedit", compact('getSingleDataProduct'));
    }

    public function productUpdate(Request $req){
        $valid = Validator::make($req->all(),[
            "code" => "required",
            "name" => "required",
            "rate" => "required"
        ]);

        if ($valid->fails()) {
            return response()->json(["status" => 0, "message" => $valid->errors()]);
        }

        $pro = product::find($req->id);
        $pro->code = $req->code;
        $pro->name = $req->name;
        $pro->rate = $req->rate;
        $pro->save();
        return response()->json(["status" => 1]);
    }


    public function getProduct(Request $req){
        $pro = product::find($req->productId);
        return response()->json(['product'=>$pro]);
    }

}
