<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Support\Facades\Validator;

class subCategoryController extends Controller
{
    public function addsubCategory(){
        $category = category::orderby("name","ASC")->get();
        return view("categorysubadd", compact('category'));
    }


    public function getsubcategorydata(Request $req){

        $subcategory = subcategory::where("categoryid", $req->categoryid)->orderby("name","ASC")->get();

        return response()->json([
            "status" => 0,
            "message" => $subcategory
        ]);


        


    }

    public function treecategory(){
        $category = category::orderby("name","ASC")->get();
        return view("treecategory", compact('category'));
    }

    public function insertsubCategory(Request $req){

        date_default_timezone_set("Asia/Dhaka");

        if ($req->isMethod("post")) {
            $valid = Validator::make($req->all(),[
                    "name" => "required|unique:subcategories,name",
                    "categoryid" => "required"
            ],[
                "name.required" => "Category must not be empty.",
                "name.unique" => "Category already exists.",
                "categoryid.required" => "Please chose any category options."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }

                $subcategory = new subcategory();
                $subcategory->name  =   $req->name;
                $subcategory->categoryid  =   $req->categoryid;
                $subcategory->save();
            }

            return response()->json([
                "status" => 3,
                "message" => "Data insert successfully!"
            ]);
    }

    

    public function listsubCategory(){
        $subcategory = subcategory::orderby("id","DESC")->get();
        return view("subcategorylist", compact('subcategory'));
    }
}
