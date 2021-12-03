<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/sauveteur/', [\App\Http\Controllers\SauveteurController::class,'index'])->name('sauveteur');
Route::get('/sauveteur/search/',[\App\Http\Controllers\SauveteurController::class,'indexSearch'])->name('sauveteurSearch');
Route::get('/sauveteur/add',[\App\Http\Controllers\SauveteurController::class,'add'])->middleware('auth')->name('addSauveteur');
Route::post('/sauveteur/store',[\App\Http\Controllers\SauveteurController::class,'store'])->middleware('auth')->name('storeSauveteur');
Route::get('/sauveteur/show/{id}',[\App\Http\Controllers\SauveteurController::class,'show'])->name('showSauveteur');
Route::get('/sauveteur/edit/{id}',[\App\Http\Controllers\SauveteurController::class,'edit'])->middleware('auth')->name('editSauveteur');
Route::post('/sauveteur/update',[\App\Http\Controllers\SauveteurController::class,'update'])->middleware('auth')->name('updateSauveteur');
Route::get('/sauveteur/addImage/{id}',[\App\Http\Controllers\SauveteurController::class,'addImage'])->middleware('auth')->name('addImageSauveteur');
Route::post('/sauveteur/storeImage/',[\App\Http\Controllers\SauveteurController::class,'storeImage'])->middleware('auth')->name('sendPictureSauveteur');
Route::post('/sauveteur/deleteImage',[\App\Http\Controllers\SauveteurController::class,'deleteImage'])->middleware('auth')->name('deleteImageSauveteur');



Route::get('/bateaux/',[\App\Http\Controllers\BateauController::class,'index'])->name('bateaux');
Route::get('/bateaux/search/',[\App\Http\Controllers\BateauController::class,'indexSearch'])->name('bateauxSearch');
Route::get('/bateaux/add/',[\App\Http\Controllers\BateauController::class,'add'])->middleware('auth')->name('addBateau');
Route::post('/bateaux/store/',[\App\Http\Controllers\BateauController::class,'store'])->middleware('auth')->name('storeBateau');
Route::get('/bateaux/show/{id}',[\App\Http\Controllers\BateauController::class,'show'])->name('showBateau');
Route::get('/bateaux/edit/{id}',[\App\Http\Controllers\BateauController::class,'edit'])->middleware('auth')->name('editBateau');
Route::post('/bateaux/update/',[\App\Http\Controllers\BateauController::class,'update'])->middleware('auth')->name('updateBateau');
Route::post('/bateau/deleteImage',[\App\Http\Controllers\BateauController::class,'deleteImage'])->middleware('auth')->name('deleteImageBateau');
Route::get('/bateau/addImage/{id}',[\App\Http\Controllers\BateauController::class,'addImage'])->middleware('auth')->name('addImageBateau');
Route::post('/bateau/storeImage',[\App\Http\Controllers\BateauController::class,'storeImage'])->middleware('auth')->name('sendPictureBateau');


Route::get('/sauvetages/',[\App\Http\Controllers\SauvetageController::class,'index'])->name('sauvetage');
Route::get('/sauvetages/search/',[\App\Http\Controllers\SauvetageController::class,'indexSearch'])->name('sauvetagesSearch');
Route::get('/sauvetages/add/',[\App\Http\Controllers\SauvetageController::class,'add'])->middleware('auth')->name('addSauvetage');
Route::post('/sauvetages/store/',[\App\Http\Controllers\SauvetageController::class,'store'])->middleware('auth')->name('storeSauvetage');
Route::get('/sauvetages/show/{id}',[\App\Http\Controllers\SauvetageController::class,'show'])->name('showSauvetage');
Route::get('/sauvetages/edit/{id}',[\App\Http\Controllers\SauvetageController::class,'edit'])->middleware('auth')->name('editSauvetage');
Route::post('/sauvetages/update/',[\App\Http\Controllers\SauvetageController::class,'update'])->middleware('auth')->name('updateSauvetage');
Route::post('/sauvetage/deleteImage',[\App\Http\Controllers\SauvetageController::class,'deleteImage'])->middleware('auth')->name('deleteImageSauvetage');
Route::get('/sauvetage/addImage/{id}',[\App\Http\Controllers\SauvetageController::class,'addImage'])->middleware('auth')->name('addImageSauvetage');
Route::post('/sauvetage/storeImage',[\App\Http\Controllers\SauvetageController::class,'storeImage'])->middleware('auth')->name('sendPictureSauvetage');

Route::get('/temoignage/{type}/{id}',[\App\Http\Controllers\TemoignageController::class,'add'])->name('addTemoignage');
Route::post('/temoignage/store',[\App\Http\Controllers\TemoignageController::class,'store'])->name('storeTemoignage');


Route::get('/admin',[\App\Http\Controllers\AdministrationController::class,'index'])->middleware('auth')->name('indexAdmin');
Route::get('/admin/temoignage/show/{id}',[\App\Http\Controllers\AdministrationController::class,'show'])->middleware('auth')->name('showAdmin');
Route::get('/admin/temoignage/accepter/{id}',[\App\Http\Controllers\AdministrationController::class,'accepter'])->middleware('auth')->name('accepterTemoignageAdmin');
Route::get('/admin/temoignage/refuser/{id}',[\App\Http\Controllers\AdministrationController::class,'refuser'])->middleware('auth')->name('refuserTemoignageAdmin');

