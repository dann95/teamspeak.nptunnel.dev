<?php


/**
 * Rotas da loja:
 */
Route::get('/' , ['uses' => 'StoreController@index' , 'as' => 'index']);
Route::get('/por-que-nos-escolher' , ['uses' => 'StoreController@porque' , 'as' => 'porque']);
Route::get('/nossos-planos' , ['uses' => 'StoreController@planos' , 'as' => 'planos']);

/**
 * Rotas do Admin:
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

    Route::group(['prefix' => 'account', 'namespace' => 'Client' , 'as' => 'account.' , 'middleware' => ['auth']] , function(){
        Route::get('/',['uses' => 'AccountController@index' , 'as' => 'index']);

});

/**
 * From laravel doc(auth)
 */
// Authentication routes...
Route::get('auth/login', ['uses' => 'Auth\AuthController@getLogin' , 'as' => 'auth.login']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', ['uses'=>'Auth\AuthController@getRegister', 'as' => 'auth.register']);
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/auth/logout' , ['uses' => 'Auth\AuthController@getLogout' , 'as' => 'auth.logout']);