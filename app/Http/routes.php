<?php

Route::group(['prefix' => 'teste'] , function(){
    Route::get('cliente' , function(){
        return view('Client.Layout.default');
    });
});
