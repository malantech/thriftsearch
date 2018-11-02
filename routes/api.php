<?php

use Illuminate\Http\Request;

/*
  Public API Routes
*/
Route::group(['prefix' => 'v1'], function(){
    Route::get('/user', 'API\UsersController@getUser');
    Route::get('/users', 'API\UsersController@getUsers');
    Route::get('/yards', 'API\YardsController@getYards');
    Route::get('/yards/{id}', 'API\YardsController@getYard');
    Route::get('/yards-types', 'API\YardsTypesController@getYardsTypes');
    Route::get('/tags', 'API\TagsController@getTags');
});

/*
  Authenticated API Routes.
*/
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::get('/companies/search', 'API\CompaniesController@getCompanySearch');
    Route::put('/user', 'API\UsersController@putUpdateUser');
    Route::get('/yards/{id}/edit', 'API\YardsController@getYardEditData');
    Route::post('/yards', 'API\YardsController@postNewYard');
    Route::put('/yards/{yardID}', 'API\YardsController@putEditYard');
    Route::post('/yards/{id}/like', 'API\YardsController@postLikeYard');
    Route::delete('/yards/{id}/like', 'API\YardsController@deleteLikeYard');
    Route::post('/yards/{id}/tags', 'API\YardsController@postAddTags');
    Route::delete('/yards/{id}/tags/{tagID}', 'API\YardsController@deleteYardTag');
    Route::delete('/yards/{id}', 'API\YardsController@deleteYard');
});
