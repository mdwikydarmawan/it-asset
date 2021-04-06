<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

});

Route::group(['middleware' => ['auth'], 'prefix' => 'ba', 'as' => 'ba.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('pks', 'BA\BAPKSController');
    Route::resource('po', 'BA\BAPOController');
    Route::get('export_pks/{id}', 'BA\BAPKSController@export')->name('export_pks');
    Route::get('report_pks/', 'BA\BAPKSController@report')->name('report_pks');
    Route::get('export_po/{id}', 'BA\BAPOController@export_po')->name('export_po');
    Route::resource('vendors_non_app', 'BA\VendorsController');
    Route::resource('billpayment', 'BA\OtherBillingController');
    Route::get('export/{id}', 'BA\OtherBillingController@export')->name('export');    
    Route::post('bapocontroller/fetch', 'BA\BAPOController@fetch')->name('bapocontroller.fetch');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'dev', 'as' => 'dev.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('applications', 'Dev\ApplicationsController');
    Route::resource('applications_enhancement', 'Dev\AppEnhancementsController');    
    Route::get('/applicationscontroller', 'Dev\ApplicationsController@index');
    Route::post('applicationscontroller/fetch', 'Dev\ApplicationsController@fetch')->name('applicationscontroller.fetch');
    Route::post('applicationscontroller/serverprod', 'Dev\ApplicationsController@serverprod')->name('applicationscontroller.serverprod');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'helpdesk', 'as' => 'helpdesk.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('server', 'Helpdesk\ServersController');
    Route::resource('recap', 'Helpdesk\RecapsController');
    Route::resource('hardware', 'Helpdesk\HardwareController');
    Route::get('export/{id}', 'Helpdesk\RecapsController@export')->name('export');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'sec', 'as' => 'sec.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('branch', 'Sec\BranchsController');
    Route::resource('license', 'Sec\LicensesController');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'param', 'as' => 'param.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('vendor', 'Param\ParameterVendorController');
    Route::resource('hardwares', 'Param\ParameterHardwareController');
    Route::resource('pic', 'Param\ParameterPicController');
    Route::resource('dc', 'Param\ParameterDcController');
    Route::resource('pkstype', 'Param\ParameterPKSController');
    Route::resource('status', 'Param\ParameterStatusController');
    Route::get('/vendor/{id}/pic', 'Param\ParameterVendorController@pic')->name('vendor.pic');
    Route::get('/vendor/{id}/edit_pic/{pic_id}', 'Param\ParameterVendorController@edit_pic')->name('vendor.edit_pic');
    Route::get('/vendor/{id}/detail_pic/{pic_id}', 'Param\ParameterVendorController@detail_pic')->name('vendor.detail_pic');
    Route::get('/vendor/{id}/destroy_pic/{pic_id}', 'Param\ParameterVendorController@destroy_pic')->name('vendor.destroy_pic');
    Route::post('/param/hardwares/import_excel', 'Param\ParameterHardwareController@import_excel');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'guidancedoc', 'as' => 'guidancedoc.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('guidancedoc', 'GuidanceDoc\GuidanceDocController');
    Route::get('export/{id}', 'GuidanceDoc\GuidanceDocController@export')->name('export');  
});

/*Route::group(['middleware' => ['auth'], 'prefix' => 'billpayment', 'as' => 'billpayment.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('billpayment', 'OtherBilling\OtherBillingController');
    Route::get('export/{id}', 'OtherBilling\OtherBillingController@export')->name('export');  
});*/
