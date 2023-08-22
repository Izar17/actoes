<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DropdownController;
Route::post('api/fetch-transaction', [DropdownController::class, 'fetchTransaction']);
Route::post('api/fetch-product', [DropdownController::class, 'fetchProduct']);
Route::post('api/fetch-activities', [DropdownController::class, 'fetchActivity']);
Route::post('api/fetch-leadpot', [DropdownController::class, 'fetchLeadPot']);
Route::post('api/fetch-procedure', [DropdownController::class, 'fetchProcedure']);

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::redirect('/', '/login')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Assets
    Route::delete('assets/destroy', 'AssetsController@massDestroy')->name('assets.massDestroy');
    Route::resource('assets', 'AssetsController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Hospitals
    Route::delete('hospitals/destroy', 'HospitalsController@massDestroy')->name('hospitals.massDestroy');
    Route::resource('hospitals', 'HospitalsController');

    // Stocks
    Route::delete('stocks/destroy', 'StocksController@massDestroy')->name('stocks.massDestroy');
    Route::resource('stocks', 'StocksController');

    // Transactions
    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::resource('transactions', 'TransactionsController');

    // Productions
    Route::delete('productions/destroy', 'ProductionsController@massDestroy')->name('productions.massDestroy');
    Route::resource('productions', 'ProductionsController');

    // Drsis
    Route::delete('drsis/destroy', 'DrsisController@massDestroy')->name('drsis.massDestroy');
    Route::resource('drsis', 'DrsisController');

    // Cancelled Order
    Route::delete('cancelled/destroy', 'CancelledController@massDestroy')->name('cancelled.massDestroy');
    Route::resource('cancelled', 'CancelledController');


});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
