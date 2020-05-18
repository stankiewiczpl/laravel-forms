<?php

Route::middleware(['web','auth'])->namespace('Stankiewiczpl\LaravelForms\Http\Controllers')->group(function (){
    Route::post('gallery/image/upload', 'ImageController@upload')->name('gallery.image.upload');
    Route::get('gallery/image/preview/{uuid?}', 'ImageController@preview')->name('gallery.image.preview');
    Route::delete('gallery/image/delete', 'ImageController@delete')->name('gallery.image.delete');
});
