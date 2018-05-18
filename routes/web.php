<?php

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

Route::get('/', 'ContactsController@index');
//Route::resource('contacts', 'ContactsController');
Auth::routes();
Route::get('/api/getcontacts', 'ContactsController@getContacts');
Route::post('/api/contacts', 'ContactsController@store');
Route::get('/api/contacts/{id}', 'ContactsController@show');
Route::put('/api/contacts/{id}/edit', 'ContactsController@update');
Route::delete('/api/contacts/{id}/delete', 'ContactsController@delete');

