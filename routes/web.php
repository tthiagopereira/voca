<?php

//Route::redirect('/', '/login');

Route::get('/', 'WelcomeController@welcome');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::resource('panelview', 'Panel\PanelViewController');

Route::get('panelgeral', 'Panel\PanelViewController@geralPanel')->name('panelgeral');

Route::get('panelspecific', 'Panel\PanelViewController@specificPanel')->name('panelspecific');

Route::get('specific', 'Panel\PanelViewController@specific')->name('specific');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('permissions', 'PermissionsController');
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('roles', 'RolesController');
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('users', 'UsersController');
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('numbers', 'NumbersController');
    Route::delete('destroynumbers', 'NumbersController@massDestroy')->name('destroynumbers');

    Route::get('destroyallnumbers', 'NumbersController@allDestroy')->name('destroyallnumbers');

    Route::get('destroyallpanels', 'NumbersController@panelDestroy')->name('destroypanelsnumbers');
    Route::get('numbers/confirme/{id}', 'NumbersController@confirme')->name('numbers.confirme');
    Route::get('numbers/call/{id}', 'NumbersController@call')->name('numbers.call');

    Route::resource('piscalls', 'PisCallsController');
    Route::get('piscalls/call/{id}', 'PisCallsController@call')->name('piscalls.call');
    Route::get('piscalls/recall/{id}', 'PisCallsController@recall')->name('piscalls.recall');
    Route::get('piscalls/approve/{id}', 'PisCallsController@approve')->name('piscalls.approve');
    Route::get('piscalls/reprove/{id}', 'PisCallsController@reprove')->name('piscalls.reprove');
    Route::get('call/suggested', 'PisCallsController@suggested')->name('call.suggested');

    Route::resource('pecalls', 'PeCallsController');
    Route::get('pecalls/call/{id}', 'PeCallsController@call')->name('pecalls.call');
    Route::get('pecalls/recall/{id}', 'PeCallsController@recall')->name('pecalls.recall');
    Route::get('pecalls/approve/{id}', 'PeCallsController@approve')->name('pecalls.approve');
    Route::get('pecalls/reprove/{id}', 'PeCallsController@reprove')->name('pecalls.reprove');

    Route::resource('guiches', 'GuichesController');

    Route::resource('dispensados', 'DismissController');

    Route::resource('selecionados', 'SelectController');

    Route::resource('panels', 'PanelsController');

    Route::resource('colors', 'ColorsController');


});
