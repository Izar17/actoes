<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Hospitals
    Route::apiResource('hospitals', 'HospitalsApiController');

    // Assets
    Route::apiResource('assets', 'AssetsApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Stocks
    Route::apiResource('stocks', 'StocksApiController');

    // Transactions
    Route::apiResource('transactions', 'TransactionsApiController');

    // Productions
    Route::apiResource('productions', 'ProductionsApiController');

    // Drsis
    Route::apiResource('drsis', 'DrsisApiController');



});
