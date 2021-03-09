<?php
Route::group(['prefix'=>'kdadmin','namespace'=>'Kd\Kdladmin\Controllers','as'=>'kd.'], function() {
	Route::get('/', function () {
    	return redirect()->route('kd.user.index');
	});
	Route::get('user', 'UserController@index')->name('user.index'); //
	Route::get('user/view/{id}', 'UserController@view')->name('user.view'); //
	Route::get('user/delete/{id}', 'UserController@delete')->name('user.delete'); //
	Route::get('user/create', 'UserController@create')->name('user.create'); //
	Route::post('user/store', 'UserController@store')->name('user.store'); //
	Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit'); //
	Route::post('user/update', 'UserController@update')->name('user.update'); //
	Route::get('user/activate/{id}', 'UserController@activate')->name('user.activate'); //

	Route::get('permission', 'PermissionController@index')->name('permission.index'); //
	Route::get('permission/view/{id}', 'PermissionController@view')->name('permission.view'); //
	Route::get('permission/create', 'PermissionController@create')->name('permission.create'); //
	Route::post('permission/store', 'PermissionController@store')->name('permission.store'); //
	Route::get('permission/edit/{id}', 'PermissionController@edit')->name('permission.edit'); //
	Route::post('permission/update', 'PermissionController@update')->name('permission.update'); //
	Route::get('permission/delete/{id}', 'PermissionController@delete')->name('permission.delete'); //
	Route::post('permission/assign/{id}', 'PermissionController@assign')->name('permission.assign'); //
	Route::post('permission/remove/{id}', 'PermissionController@remove')->name('permission.remove'); //

	Route::get('assignment', 'AssignmentController@index')->name('assignment.index'); //
	Route::get('assignment/view/{id}', 'AssignmentController@view')->name('assignment.view'); //
	Route::post('assignment/assign/{id}', 'AssignmentController@assign')->name('assignment.assign'); //
	Route::post('assignment/revoke/{id}', 'AssignmentController@revoke')->name('assignment.revoke'); //

	Route::get('menu', 'MenuController@index')->name('menu.index');
	Route::get('menu/view/{id}', 'MenuController@view')->name('menu.view');
	Route::get('menu/create', 'MenuController@create')->name('menu.create');
	Route::get('menu/edit/{id}', 'MenuController@update')->name('menu.edit');
	Route::post('menu/update', 'MenuController@update')->name('menu.update');
	Route::get('menu/delete/{id}', 'MenuController@delete')->name('menu.delete');
});
