<?php

Route::get('/' , 'FrontController@index');

Route::group(['prefix' => 'teste'] , function(){

});


/**
 * Rotas Definitivas:
 */

Route::group(['prefix' => 'admin' , 'namespace' => 'Admin'] ,function(){

    Route::get('/' , function(){
        return 123;
    });

    Route::group(['prefix' => 'plan' , 'as' => 'plan.'] , function(){
        Route::get('/' , ['uses' => 'PlanController@index' , 'as' => 'index']);

        Route::get('create' , ['uses' => 'PlanController@create' , 'as' => 'create']);
        Route::post('store' , ['uses' => 'PlanController@store' , 'as' => 'store']);

        Route::get('delete/{id}' , ['uses' => 'PlanController@destroy' , 'as' => 'delete']);

    });

    Route::group(['prefix' => 'server' , 'as' => 'server.'] , function(){
        Route::get('/' , ['uses' => 'ServerController@index' , 'as' => 'index']);

        Route::get('/create' , ['uses' => 'ServerController@create' , 'as' => 'create']);
        Route::post('/store' ,['uses' => 'ServerController@store' , 'as' => 'store']);
    });

});
