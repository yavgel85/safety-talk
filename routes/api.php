<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], static function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Companies
    Route::post('companies/media', 'CompaniesApiController@storeMedia')->name('companies.storeMedia');
    Route::apiResource('companies', 'CompaniesApiController');

    // Instructions
    Route::post('instructions/media', 'InstructionsApiController@storeMedia')->name('instructions.storeMedia');
    Route::apiResource('instructions', 'InstructionsApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

    // Workers
    Route::apiResource('workers', 'WorkersApiController');

    // Workers Lists
    Route::apiResource('workers-lists', 'WorkersListsApiController');

    // Statuses
    Route::apiResource('statuses', 'StatusesApiController');

    // Sent Instructions
    Route::apiResource('sent-instructions', 'SentInstructionsApiController');

});
