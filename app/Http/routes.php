<?php

Route::group(
    ['prefix' => 'api/v1'],
    function () {
        Route::resource('articles', 'Api\ArticlesController', [
            'only' => ['index', 'store', 'show', 'update', 'destroy']
        ]);
    }
);
