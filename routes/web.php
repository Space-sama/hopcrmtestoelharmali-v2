<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/edit_data/{contact}/{org}', [ContactController::class, 'edit_data']);
Route::get('/', [ContactController::class, 'index']);
Route::get('/add_contact', [ContactController::class, 'createOneContact']);
Route::get('/edit_contact/{contact}', [ContactController::class, 'editContact']);
Route::post('/add_contact_action', [ContactController::class, 'createOneContactAction']);

Route::put('/edit_contact_action/{contact}', [ContactController::class, 'editOneContactAction']);
Route::get('/edit_contact_action2/{contact}', [ContactController::class, 'editOneContactAction2']);
Route::put('edit_data_modal/{contact}/{org}', [ContactController::class, 'editDataModal']);
Route::delete('delete_contact/{contact}', [ContactController::class, 'deleteContact']);
Route::get('/add_contact_action_on_confirm/{nom}/{prenom}/{email}/{telephone_fixe}/{fonction}/{service}/{org_name}/{adresse}/{code_postal}/{ville}/{statut}',
    [ContactController::class, 'createOnConfirm']);

