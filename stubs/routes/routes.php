<?php
// FRmoduleName
// FRUmoduleName
Route::group(['prefix' => 'controle/FRmoduleName/', 'namespace' => 'App\\Modules\\FRUmoduleName\\Controllers', 'middleware' => ['web', 'admin']], function () {

    Route::get('/', ['as' => 'admin.FRmoduleName.gerenciar', 'uses' => 'FRUmoduleNameController@gerenciar']);
    Route::get('/novo', ['as' => 'admin.FRmoduleName.novo', 'uses' => 'FRUmoduleNameController@novo']);
    Route::get('/alterar/{id}', ['as' => 'admin.FRmoduleName.alterar', 'uses' => 'FRUmoduleNameController@alterar']);

    Route::post('/store', ['as' => 'admin.FRmoduleName.store', 'uses' => 'FRUmoduleNameController@store']);
    Route::put('/update/{id}', ['as' => 'admin.FRmoduleName.update', 'uses' => 'FRUmoduleNameController@update']);
    Route::get('/delete/{id}', ['as' => 'admin.FRmoduleName.delete', 'uses' => 'FRUmoduleNameController@delete']);


});

Route::group(['namespace' => 'App\\Modules\\FRUmoduleName\\Controllers', 'prefix' => 'FRmoduleNames',], function () {
    Route::get('/', ['as' => 'front.FRmoduleName.all', 'uses' => 'FRUmoduleNameController@frontIndex']);
    Route::get('/{slug}', ['as' => 'front.FRmoduleName.single', 'uses' => 'FRUmoduleNameController@frontSingle']);
});