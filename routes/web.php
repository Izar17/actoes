<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DropdownController;
Route::post('api/fetch-transaction', [DropdownController::class, 'fetchTransaction']);
Route::post('api/fetch-product', [DropdownController::class, 'fetchProduct']);
Route::post('api/fetch-activities', [DropdownController::class, 'fetchActivity']);
Route::post('api/fetch-leadpot', [DropdownController::class, 'fetchLeadPot']);
Route::post('api/fetch-procedure', [DropdownController::class, 'fetchProcedure']);
Route::post('api/fetch-form', [DropdownController::class, 'fetchForm']);

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

    // Dashboard
    Route::resource('dashboard', 'DashboardController');

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
    Route::get('hospitals/hospital_price', 'HospitalsController@hospitalPrice')->name('hospitals.hospital_price');
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
    Route::get('drsis/wip', 'DrsisController@wip')->name('drsis.wip');
    Route::get('drsis/cancelledDr', 'DrsisController@cancelledDr')->name('drsis.cancelledDr');
    Route::get('drsis/cancelledSi', 'DrsisController@cancelledSi')->name('drsis.cancelledSi');
    Route::resource('drsis', 'DrsisController');
    Route::get('printdrsi/printDr', 'PrintDrsiController@printDr')->name('printdrsi.printDr');
    Route::get('printdrsi/printSi', 'PrintDrsiController@printSi')->name('printdrsi.printSi');
    Route::get('printdrsi/searchDrsi', 'PrintDrsiController@searchDrsi')->name('printdrsi.searchDrsi');
    Route::get('printdrsi/searchByDrsi', 'PrintDrsiController@searchByDrsi')->name('printdrsi.searchByDrsi');
    Route::get('printdrsi/cancelDrsi', 'PrintDrsiController@cancelDrsi')->name('printdrsi.cancelDrsi');
    Route::resource('printdrsi', 'PrintDrsiController');

    // Cancelled Order
    Route::resource('cancelled', 'CancelledController');

    // Records
    Route::resource('records', 'RecordsController');

    // Report
    Route::get('reports/print/page1', 'ReportsController@print')->name('reports.print.print');
    Route::get('reports/print/page2', 'ReportsController@print')->name('reports.print.print2');
    Route::get('reports/print/page3', 'ReportsController@print')->name('reports.print.print3');
    Route::get('reports/print/page4', 'ReportsController@print')->name('reports.print.print4');
    Route::resource('reports', 'ReportsController');
    //Route::get('/admin/reports/search', [ReportsController::class, 'search'])->name('reports.search');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
