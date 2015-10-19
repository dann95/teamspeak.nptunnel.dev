<?php

use NpTS\Domain\TeamSpeak\Manager;
use NpTS\Domain\Admin\Repositories\Contracts\ServerRepositoryContract;

Route::get('/' , 'FrontController@index');

Route::group(['prefix' => 'teste'] , function(){
    Route::get('cliente' , function(){
        return view('Client.Layout.default');
    });


    Route::get('ts',function(){
       $credentials = [
           'user' => 'serveradmin',
           'password' => env('tomaspwd'),
           'ip' => env('tomasip'),
       ];
        $manager = new Manager($credentials);

        $manager->startServerBySid(2);

    });

    Route::get('server' , function(ServerRepositoryContract $repo){
        dd($repo->delete(55));
    });
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

});
