<?php

use NpTS\Domain\TeamSpeak\Manager;

Route::group(['prefix' => 'teste'] , function(){
    Route::get('cliente' , function(){
        return view('Client.Layout.default');
    });


    Route::get('ts',function(){
       $credentials = [
           'user' => 'serveradmin',
           'password' => 'password',
           'ip' => 'ip',
       ];
        $manager = new Manager($credentials);

        $manager->startServerBySid(2);

    });
});
