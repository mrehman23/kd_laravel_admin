<?php

// Route::get('kdadmin', function () {
//     return redirect('kdadmin/user');
//     // return redirect()->route('usr');
// });

Route::prefix('kdadmin')->name('kd.')->group(function () {
	Route::get('/', function () {
    	return redirect()->route('kd.user.index');
	});
	// Route::get('user','Kd\Kdladmin\Controllers\UserController@welcome')->name('usr');

	Route::get('user', 'Kd\Kdladmin\Controllers\UserController@index')->name('user.index'); //
	Route::get('user/view/{id}', 'Kd\Kdladmin\Controllers\UserController@view')->name('user.view'); //
	Route::get('user/delete/{id}', 'Kd\Kdladmin\Controllers\UserController@delete')->name('user.delete'); //
	Route::get('user/create', 'Kd\Kdladmin\Controllers\UserController@create')->name('user.create'); //
	Route::post('user/store', 'Kd\Kdladmin\Controllers\UserController@store')->name('user.store'); //
	Route::get('user/edit/{id}', 'Kd\Kdladmin\Controllers\UserController@edit')->name('user.edit'); //
	Route::post('user/update', 'Kd\Kdladmin\Controllers\UserController@update')->name('user.update'); //
	Route::get('user/countries', 'Kd\Kdladmin\Controllers\UserController@countries')->name('user.countries');
	Route::get('user/request-password-reset', 'Kd\Kdladmin\Controllers\UserController@request')->name('user.request');
	Route::get('user/reset-password', 'Kd\Kdladmin\Controllers\UserController@reset')->name('user.reset');
	Route::get('user/activate/{id}', 'Kd\Kdladmin\Controllers\UserController@activate')->name('user.activate'); //

	Route::get('permission', 'Kd\Kdladmin\Controllers\PermissionController@index')->name('permission.index'); //
	Route::get('permission/view/{id}', 'Kd\Kdladmin\Controllers\PermissionController@view')->name('permission.view'); //
	Route::get('permission/create', 'Kd\Kdladmin\Controllers\PermissionController@create')->name('permission.create'); //
	Route::post('permission/store', 'Kd\Kdladmin\Controllers\PermissionController@store')->name('permission.store'); //
	Route::get('permission/edit/{id}', 'Kd\Kdladmin\Controllers\PermissionController@edit')->name('permission.edit'); //
	Route::post('permission/update', 'Kd\Kdladmin\Controllers\PermissionController@update')->name('permission.update'); //
	Route::get('permission/delete/{id}', 'Kd\Kdladmin\Controllers\PermissionController@delete')->name('permission.delete'); //
	Route::post('permission/assign/{id}', 'Kd\Kdladmin\Controllers\PermissionController@assign')->name('permission.assign'); //
	Route::post('permission/remove/{id}', 'Kd\Kdladmin\Controllers\PermissionController@remove')->name('permission.remove'); //

	Route::get('assignment', 'Kd\Kdladmin\Controllers\AssignmentController@index')->name('assignment.index');
	Route::get('assignment/view/{id}', 'Kd\Kdladmin\Controllers\AssignmentController@view')->name('assignment.view');
	Route::post('assignment/assign/{id}', 'Kd\Kdladmin\Controllers\AssignmentController@assign')->name('assignment.assign');
	Route::post('assignment/revoke/{id}', 'Kd\Kdladmin\Controllers\AssignmentController@revoke')->name('assignment.revoke');
	// Route::get('assignment/*', 'Kd\Kdladmin\Controllers\AssignmentController@*')->name('');

	Route::get('default/index', 'Kd\Kdladmin\Controllers\DefaultController@index')->name('default.index');
	// Route::get('default/*', 'Kd\Kdladmin\Controllers\DefaultController@*')->name('');

	Route::get('menu/index', 'Kd\Kdladmin\Controllers\MenuController@index')->name('menu.index');
	Route::get('menu/view', 'Kd\Kdladmin\Controllers\MenuController@view')->name('menu.view');
	Route::get('menu/create', 'Kd\Kdladmin\Controllers\MenuController@create')->name('menu.create');
	Route::get('menu/update', 'Kd\Kdladmin\Controllers\MenuController@update')->name('menu.update');
	Route::get('menu/delete', 'Kd\Kdladmin\Controllers\MenuController@delete')->name('menu.delete');
	// Route::get('menu/*', 'Kd\Kdladmin\Controllers\MenuController@*')->name('');

	Route::get('org/index', 'Kd\Kdladmin\Controllers\OrgController@index')->name('org.index');
	Route::get('org/create', 'Kd\Kdladmin\Controllers\OrgController@create')->name('org.create');
	Route::get('org/view', 'Kd\Kdladmin\Controllers\OrgController@view')->name('org.view');
	Route::get('org/delete', 'Kd\Kdladmin\Controllers\OrgController@delete')->name('org.delete');
	Route::get('org/activate', 'Kd\Kdladmin\Controllers\OrgController@activate')->name('org.activate');
	// Route::get('org/*', 'Kd\Kdladmin\Controllers\OrgController@*')->name('');

	Route::get('branch/index', 'Kd\Kdladmin\Controllers\BranchController@index')->name('branch.index');
	Route::get('branch/create', 'Kd\Kdladmin\Controllers\BranchController@create')->name('branch.create');
	Route::get('branch/view', 'Kd\Kdladmin\Controllers\BranchController@view')->name('branch.view');
	Route::get('branch/delete', 'Kd\Kdladmin\Controllers\BranchController@delete')->name('branch.delete');
	Route::get('branch/activate', 'Kd\Kdladmin\Controllers\BranchController@activate')->name('branch.activate');
	// Route::get('branch/*', 'Kd\Kdladmin\Controllers\BranchController@*')->name('');

	Route::get('role/index', 'Kd\Kdladmin\Controllers\RoleController@index')->name('role.index');
	Route::get('role/view', 'Kd\Kdladmin\Controllers\RoleController@view')->name('role.view');
	Route::get('role/create', 'Kd\Kdladmin\Controllers\RoleController@create')->name('role.create');
	Route::get('role/update', 'Kd\Kdladmin\Controllers\RoleController@update')->name('role.update');
	Route::get('role/delete', 'Kd\Kdladmin\Controllers\RoleController@delete')->name('role.delete');
	Route::get('role/assign', 'Kd\Kdladmin\Controllers\RoleController@assign')->name('role.assign');
	Route::get('role/remove', 'Kd\Kdladmin\Controllers\RoleController@remove')->name('role.remove');
	//Route::get('role/*', 'Kd\Kdladmin\Controllers\RoleController@*')->name('');



	Route::get('route/index', 'Kd\Kdladmin\Controllers\RouteController@index')->name('route.index');
	Route::get('route/create', 'Kd\Kdladmin\Controllers\RouteController@create')->name('route.create');
	Route::get('route/assign', 'Kd\Kdladmin\Controllers\RouteController@assign')->name('route.assign');
	Route::get('route/remove', 'Kd\Kdladmin\Controllers\RouteController@remove')->name('route.remove');
	Route::get('route/refresh', 'Kd\Kdladmin\Controllers\RouteController@refresh')->name('route.refresh');
	// Route::get('route/*', 'Kd\Kdladmin\Controllers\RouteController@*')->name('');

	Route::get('rule/index', 'Kd\Kdladmin\Controllers\RuleController@index')->name('rule.index');
	Route::get('rule/view', 'Kd\Kdladmin\Controllers\RuleController@view')->name('rule.view');
	Route::get('rule/create', 'Kd\Kdladmin\Controllers\RuleController@create')->name('rule.create');
	Route::get('rule/update', 'Kd\Kdladmin\Controllers\RuleController@update')->name('rule.update');
	Route::get('rule/delete', 'Kd\Kdladmin\Controllers\RuleController@delete')->name('rule.delete');
	// Route::get('rule/*', 'Kd\Kdladmin\Controllers\RuleController@*')->name('');
});


// Route::get('kdadmin/user', 'Kd\Kdladmin\Controllers\UserController@welcome')->name('usr');
