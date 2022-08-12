<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    public function addCategory(){
        return view("categoryadd");
    }

    public function insertCategory(Request $req){

        date_default_timezone_set("Asia/Dhaka");

        if ($req->isMethod("post")) {
            $valid = Validator::make($req->all(),[
                    "name" => "required|unique:categories",
            ],[
                "name.required" => "Category must not be empty.",
                "name.unique" => "Category already exists."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }

                $category = new category();
                $category->name       =   $req->name;
                $category->save();
            }

            return response()->json([
                "status" => 3,
                "message" => "Data insert successfully!"
            ]);
    }

    

    public function listCategory(){
        $category = category::orderby("id","DESC")->get();
        return view("categorylist", compact('category'));
    }


}
