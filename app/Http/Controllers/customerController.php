<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\Validator;

class customerController extends Controller
{

    public function custmoerAdd(){
        return view("customerAdd");
    }

    public function custmoerInsert(Request $req){
        $valid = Validator::make($req->all(),[
            "name" => "required",
            "phone" => "required",
            "address" => "required"
        ],[
            "name.required" => "Name field is required.",
            "phone.required" => "Phone field is required.",
            "address.required" => "Address field is required."
        ]);

        if ($valid->fails()) {
            return response()->json(["status" => 0, "message" => $valid->errors()]);
        }

        $cus = new customer();
        $cus->name = $req->name;
        $cus->phone = $req->phone;
        $cus->address = $req->address;
        $cus->save();
        return response()->json(["status" => 1, "message" => "Customer data insert successfully!"]);
    }


    public function customerlist(){
        $getcustomer = customer::orderby("id","DESC")->get();
        return view("customerlist", compact('getcustomer'));
    }


    public function cusDel($id){
        $getcustomer = customer::findorFail($id)->delete();
        return redirect("/customerlist");
    }

    public function cusEdit($id){
        $getSingleData = customer::findorFail($id);
        return view("customeredit", compact('getSingleData'));
    }


    public function customerUpdate(Request $req){


        $valid = Validator::make($req->all(),[
            "name" => "required",
            "phone" => "required",
            "address" => "required"
        ],[
            "name.required" => "Name field is required.",
            "phone.required" => "Phone field is required.",
            "address.required" => "Address field is required."
        ]);

        if ($valid->fails()) {
            return response()->json(["status" => 0, "message" => $valid->errors()]);
        }

        $cus = customer::find($req->id);
        $cus->name = $req->name;
        $cus->phone = $req->phone;
        $cus->address = $req->address;
        $cus->save();
        return response()->json(["status" => 1]);
    }


}
