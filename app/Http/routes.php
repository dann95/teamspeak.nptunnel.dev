<?php

use NpTS\Domain\TeamSpeak\Manager;


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
});
