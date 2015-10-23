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
        Route::get('/virtual/{id}/settings' , ['uses' => 'VirtualServerController@settings' , 'as' => 'virtual.settings']);
        Route::get('/virtual/{id}/privilege-keys' , ['uses' => 'VirtualServerController@privilegeKeys' , 'as' => 'virtual.keys']);
        Route::get('/virtual/{id}/ban-list' , ['uses' => 'VirtualServerController@banList' , 'as' => 'virtual.ban']);
        Route::get('/virtual/{id}/ts-bot' , ['uses' => 'VirtualServerController@tsBot' , 'as' => 'virtual.bot']);

        Route::get('/virtual/{id}/power-on' , ['uses' => 'VirtualServerController@powerOn' , 'as' => 'virtual.powerOn']);
        Route::get('/virtual/{id}/power-off' , ['uses' => 'VirtualServerController@powerOff' , 'as' => 'virtual.powerOff']);

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