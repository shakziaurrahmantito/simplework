<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\subCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/



//***For categoryController contorller
Route::get("/",[categoryController::class,"addCategory"]);
Route::post("/insertCategory",[categoryController::class,"insertCategory"]);
Route::get("/listCategory",[categoryController::class,"listCategory"]);



//***For subCategoryController contorller

Route::get("/addsubCategory",[subCategoryController::class,"addsubCategory"]);

Route::post("/insertsubCategory",[subCategoryController::class,"insertsubCategory"]);
Route::get("/listsubCategory",[subCategoryController::class,"listsubCategory"]);
Route::get("/treecategory",[subCategoryController::class,"treecategory"]);
Route::get("/getsubcategorydata",[subCategoryController::class,"getsubcategorydata"]);



