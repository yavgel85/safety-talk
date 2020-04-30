<?php

Route::redirect('/', '/login');
Route::get('/home', static function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], static function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Companies
    Route::delete('companies/destroy', 'CompaniesController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompaniesController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompaniesController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::resource('companies', 'CompaniesController');

    // Instructions
    Route::delete('instructions/destroy', 'InstructionsController@massDestroy')->name('instructions.massDestroy');
    Route::post('instructions/media', 'InstructionsController@storeMedia')->name('instructions.storeMedia');
    Route::post('instructions/ckmedia', 'InstructionsController@storeCKEditorImages')->name('instructions.storeCKEditorImages');
    Route::resource('instructions', 'InstructionsController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Workers
    Route::delete('workers/destroy', 'WorkersController@massDestroy')->name('workers.massDestroy');
    Route::resource('workers', 'WorkersController');

    // Workers Lists
    Route::delete('workers-lists/destroy', 'WorkersListsController@massDestroy')->name('workers-lists.massDestroy');
    Route::resource('workers-lists', 'WorkersListsController');

    // Statuses
    Route::delete('statuses/destroy', 'StatusesController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusesController');

    // Sent Instructions
    Route::delete('sent-instructions/destroy', 'SentInstructionsController@massDestroy')->name('sent-instructions.massDestroy');
    Route::resource('sent-instructions', 'SentInstructionsController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], static function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
