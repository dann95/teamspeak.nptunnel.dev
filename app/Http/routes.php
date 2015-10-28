<?php


/**
 * Rotas da loja:
 */
Route::get('/' , ['uses' => 'StoreController@index' , 'as' => 'index']);
Route::get('/por-que-nos-escolher' , ['uses' => 'StoreController@porque' , 'as' => 'porque']);
Route::get('/nossos-planos' , ['uses' => 'StoreController@planos' , 'as' => 'planos']);

Route::get('create/server/plan/{id}' , ['uses' => 'StoreController@planSelect' , 'as' => 'plan.select' , 'middleware' => 'auth']);


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

        /**
         * Index Account
         */
        Route::get('/',['uses' => 'AccountController@index' , 'as' => 'index']);

        /**
         * Virtual Server routes:
         */
        Route::group(['prefix' => 'virtual/{id}' , 'as' => 'virtual.'] , function(){
            Route::get('settings' , ['uses' => 'VirtualServerController@settings' , 'as' => 'settings']);
            Route::get('privilege-keys' , ['uses' => 'VirtualServerController@privilegeKeys' , 'as' => 'keys']);
            Route::get('ban-list' , ['uses' => 'VirtualServerController@banList' , 'as' => 'ban']);
            Route::get('del-ban/{banId}' , ['uses' => 'VirtualServerController@delBan' , 'as' => 'ban.del'])->where(
                ['banId' => '[0-9]+']
            );
            Route::get('ts-bot' , ['uses' => 'VirtualServerController@tsBot' , 'as' => 'bot']);
            Route::get('power-on' , ['uses' => 'VirtualServerController@powerOn' , 'as' => 'powerOn']);
            Route::get('power-off' , ['uses' => 'VirtualServerController@powerOff' , 'as' => 'powerOff']);
            /**
             * post methods!
             */
            Route::post('change-password' , ['uses' => 'VirtualServerController@password' , 'as' => 'password']);
            Route::post('change-messages' , ['uses' => 'VirtualServerController@messages' , 'as'  =>  'messages']);
            Route::post('change-banner' , ['uses' => 'VirtualServerController@banner' , 'as'  =>  'banner']);
            Route::post('create-privilege-key' , ['uses' => 'VirtualServerController@createPrivilegeKey' , 'as' => 'keys.create']);
        });

        /**
         * Cart Routes:
         */
        Route::group(['prefix' => 'cart' , 'as' => 'cart.'] , function(){
            Route::get('/',['uses' => 'CartController@index' , 'as' => 'index']);
            Route::post('add' , ['uses' => 'CartController@add' , 'as' => 'add']);
        });

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