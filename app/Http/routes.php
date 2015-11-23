<?php


/**
 * Rotas da loja:
 */
Route::get('/', ['uses' => 'StoreController@index', 'as' => 'index']);
Route::get('/por-que-nos-escolher', ['uses' => 'StoreController@porque', 'as' => 'porque']);
Route::get('/nossos-planos', ['uses' => 'StoreController@planos', 'as' => 'planos']);

Route::get('create/server/plan/{id}', ['uses' => 'StoreController@planSelect', 'as' => 'plan.select', 'middleware' => 'auth']);


/**
 * Rotas do Admin:
 */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth.admin'], function () {

    Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
    Route::group(['prefix' => 'plan', 'as' => 'plan.'], function () {
        Route::get('/', ['uses' => 'PlanController@index', 'as' => 'index']);
        Route::get('create', ['uses' => 'PlanController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'PlanController@store', 'as' => 'store']);
        Route::get('power/{id}', ['uses' => 'PlanController@power', 'as' => 'power']);

        Route::get('edit/{id}', ['uses' => 'PlanController@edit', 'as' => 'edit']);
        Route::post('update/{id}', ['uses' => 'PlanController@update', 'as' => 'update']);
    });

    Route::group(['prefix' => 'server', 'as' => 'server.'], function () {
        Route::get('/', ['uses' => 'ServerController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'ServerController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'ServerController@store', 'as' => 'store']);


        Route::get('edit/{id}', ['uses' => 'ServerController@edit', 'as' => 'edit']);
        Route::post('update/{id}', ['uses' => 'ServerController@update', 'as' => 'update']);
        Route::get('active/{id}', ['uses' => 'ServerController@active', 'as' => 'active']);
        Route::get('active-sales/{id}', ['uses' => 'ServerController@activeSales', 'as' => 'active.sales']);
    });

    Route::group(['prefix' => 'virtual-server', 'as' => 'virtual.'], function () {
        Route::get('/', ['uses' => 'VirtualServerController@index', 'as' => 'index']);
    });

    Route::group(['prefix' => 'help', 'as' => 'help'], function () {

    });

    Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
        Route::get('/', ['uses' => 'ClientController@index', 'as' => 'index']);
    });


});

Route::group(['prefix' => 'account', 'namespace' => 'Client', 'as' => 'account.', 'middleware' => ['auth', 'active', 'banned']], function () {

    /**
     * Index Account
     */
    Route::get('/', ['uses' => 'AccountController@index', 'as' => 'index']);

    Route::get('/settings', ['uses' => 'AccountController@settings', 'as' => 'settings']);
    Route::post('/password',['uses' => 'AccountController@password' , 'as' => 'password']);
    Route::post('/personal-data' , ['uses' => 'AccountController@personal' , 'as' => 'personal']);
    /**
     * Invoices
     */
    Route::get('/meus-pedidos', ['uses' => 'AccountController@invoices', 'as' => 'invoices']);
    Route::get('pedido/{id}', ['uses' => 'AccountController@showInvoice', 'as' => 'invoice.show']);

    /**
     * Subscriptions
     */
    Route::get('/subscriptions', ['uses' => 'AccountController@subscriptions' , 'as' => 'subscriptions']);

    /**
     * Virtual Server routes:
     */
    Route::group(['prefix' => 'virtual/{id}', 'as' => 'virtual.'], function () {
        Route::get('settings', ['uses' => 'VirtualServerController@settings', 'as' => 'settings']);
        Route::get('privilege-keys', ['uses' => 'VirtualServerController@privilegeKeys', 'as' => 'keys']);
        Route::get('ban-list', ['uses' => 'VirtualServerController@banList', 'as' => 'ban']);
        Route::get('del-ban/{banId}', ['uses' => 'VirtualServerController@delBan', 'as' => 'ban.del'])->where(
            ['banId' => '[0-9]+']
        );
        Route::get('power-on', ['uses' => 'VirtualServerController@powerOn', 'as' => 'powerOn']);
        Route::get('power-off', ['uses' => 'VirtualServerController@powerOff', 'as' => 'powerOff']);
        /**
         * post methods!
         */
        Route::post('change-password', ['uses' => 'VirtualServerController@password', 'as' => 'password']);
        Route::post('change-messages', ['uses' => 'VirtualServerController@messages', 'as' => 'messages']);
        Route::post('change-banner', ['uses' => 'VirtualServerController@banner', 'as' => 'banner']);
        Route::post('create-privilege-key', ['uses' => 'VirtualServerController@createPrivilegeKey', 'as' => 'keys.create']);

        /**
         * TS BOT:
         */
        Route::group(['prefix' => 'ts-bot', 'as' => 'bot.'], function () {
            Route::get('/', ['uses' => 'TsBOTController@index', 'as' => 'index']);
            Route::post('/settings' , ['uses' => 'TsBOTController@settings' , 'as' => 'settings']);
            Route::get('/tibia/settings', ['uses' => 'TsBOTController@tibia', 'as' => 'tibiaSettings']);
            Route::post('/tibia/settings', ['uses' => 'TsBOTController@tibiaSettings', 'as' => 'tibiaSettingsUpdate']);
            Route::group(['prefix' => 'friend', 'as' => 'friend.'], function () {
                Route::get('/', ['uses' => 'TsBOTController@listFriends', 'as' => 'index']);
                Route::get('/guilds', ['uses' => 'TsBOTController@listGuildsFriend', 'as' => 'guild.index']);
                Route::get('/add', ['uses' => 'TsBOTController@add', 'as' => 'add']);
                Route::post('/add', ['uses' => 'TsBOTController@storeFriend', 'as' => 'store']);
                Route::get('/guild/add', ['uses' => 'TsBOTController@addGuild', 'as' => 'guild.add']);
                Route::post('/guild/add', ['uses' => 'TsBOTController@storeGuildFriend', 'as' => 'guild.store']);
                Route::get('remove', ['uses' => 'TsBOTController@del', 'as' => 'del']);
                Route::get('/guild/remove', ['uses' => 'TsBOTController@delGuild', 'as' => 'guild.del']);
            });
            Route::group(['prefix' => 'enemy', 'as' => 'enemy.'], function () {
                Route::get('/', ['uses' => 'TsBOTController@listEnemies', 'as' => 'index']);
                Route::get('/guilds', ['uses' => 'TsBOTController@listGuildsEnemy', 'as' => 'guild.index']);
                Route::get('/add', ['uses' => 'TsBOTController@addEnemy', 'as' => 'add']);
                Route::post('/add', ['uses' => 'TsBOTController@storeEnemy', 'as' => 'store']);
                Route::get('/guild/add', ['uses' => 'TsBOTController@addGuildEnemy', 'as' => 'guild.add']);
                Route::post('/guild/add', ['uses' => 'TsBOTController@storeGuildEnemy', 'as' => 'guild.store']);
                Route::get('remove', ['uses' => 'TsBOTController@delEnemy', 'as' => 'del']);
                Route::get('/guild/remove', ['uses' => 'TsBOTController@delGuildEnemy', 'as' => 'guild.del']);
            });

        });

    });

    /**
     * Cart Routes:
     */
    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('/', ['uses' => 'CartController@index', 'as' => 'index']);
        Route::get('del/{id}', ['uses' => 'CartController@del', 'as' => 'del']);
        Route::post('add', ['uses' => 'CartController@add', 'as' => 'add']);
        Route::get('checkout', ['uses' => 'CheckoutController@index', 'as' => 'checkout']);
        Route::post('checkout', ['uses' => 'CheckoutController@checkout']);
    });

    Route::group(['prefix' => 'help-desk', 'as' => 'help.'], function () {
        Route::get('create', ['uses' => 'HelpDeskController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'HelpDeskController@store', 'as' => 'store']);
        Route::get('/', ['uses' => 'HelpDeskController@index', 'as' => 'index']);
        Route::get('{id}', ['uses' => 'HelpDeskController@show', 'as' => 'show']);
        Route::post('{id}/post-repply', ['uses' => 'HelpDeskController@storeAnswer', 'as' => 'answer']);
    });


});

/**
 * From laravel doc(auth)
 */

Route::get('auth/active/{key}', ['as' => 'auth.activate', 'uses' => 'Auth\AuthController@activateUser']);

// Authentication routes...
Route::get('auth/login', ['uses' => 'Auth\AuthController@getLogin', 'as' => 'auth.login']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', ['uses' => 'Auth\AuthController@getRegister', 'as' => 'auth.register']);
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/auth/logout', ['uses' => 'Auth\AuthController@getLogout', 'as' => 'auth.logout']);