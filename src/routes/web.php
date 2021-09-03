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

Route::get('/', function () {
    return view('assignment.index');
})->name('assignment_dashboard');

Route::group(['prefix' => 'web-assignment'], function() {
    Route::get('/list', 'AssignmentController@index')->name('books_list');
    Route::get('/create', 'AssignmentController@create')->name('create_book');
    Route::post('/post', 'AssignmentController@store')->name('save_book');
    Route::get('/edit/{id}', 'AssignmentController@edit')->name('edit_book');
    Route::post('/update/{id}', 'AssignmentController@update')->name('update_book');
    Route::get('/delete/{id}', 'AssignmentController@destroy')->name('delete_book');
    Route::get('/csv-export/{parameter}','AssignmentController@exportInCSV')->name('csv_export_data');
    Route::get('/xml-export/{parameter}','AssignmentController@exportInXML')->name('xml_export_data');
});


