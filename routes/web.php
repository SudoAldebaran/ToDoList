<?php

use App\Http\Controllers\toDoListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [toDoListController::class, 'index']);

Route::post('/saveItem', [toDoListController::class, 'saveItem'])-> name('saveItemRoute');

Route::post('/markComplete/{id}', [toDoListController::class, 'mark'])-> name('markCompleteRoute');

Route::post('/markIncomplete/{id}', [toDoListController::class, 'unmark'])-> name('markIncompleteRoute');
