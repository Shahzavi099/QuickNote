<?php

use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Note;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
Route::get('/notes',[NoteController::class,'index']);
Route::get('/notes/{id}', [NoteController::class,'show']);
Route::delete('/notes/{id}',[NoteController::class,'destroy']);
Route::post('/notes', [NoteController::class, 'store']);
Route::patch('/notes/{id}',[NoteController::class,'update']);