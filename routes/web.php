<?php

use App\Http\Controllers\indexController;
use App\Models\DocTbl;
use Illuminate\Support\Facades\Route;

// For Routing Pages
Route::get('/', function () {
    $readDocTbl = DocTbl::all();
    return view('index', ['readDocTbl'=>$readDocTbl]);
});
// For Routing Pages End

Route::post('/convertDocToPdfAction', [indexController::class, 'convertDocToPdfAction']);