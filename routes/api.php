<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::middleware('recaptcha')->group(function () {
        Route::post('/token', 'App\Http\Controllers\UserController@token');
        Route::post('/login', 'App\Http\Controllers\UserController@login');
    });

    Route::post('/news/image', 'App\Http\Controllers\NewsController@imageCreate');
    Route::delete('/news/image', 'App\Http\Controllers\NewsController@imageDelete');
    Route::post('/news/youtube', 'App\Http\Controllers\NewsController@youtubeCreate');

    Route::post('/page/image', 'App\Http\Controllers\PageController@imageCreate');
    Route::delete('/page/image', 'App\Http\Controllers\PageController@imageDelete');
    Route::post('/page/youtube', 'App\Http\Controllers\PageController@youtubeCreate');

    Route::middleware('auth:sanctum')->group(function () {
        
        // CRUD for Users
        Route::get('/users', 'App\Http\Controllers\UserController@index');
        Route::post('/user', 'App\Http\Controllers\UserController@create');
        Route::get('/user', 'App\Http\Controllers\UserController@show');
        Route::get('/user/{id}', 'App\Http\Controllers\UserController@show');
        Route::put('/user/{id}', 'App\Http\Controllers\UserController@update');
        Route::delete('/user/{id}', 'App\Http\Controllers\UserController@delete');
        
        // CRUD for Roles
        Route::get('/roles', 'App\Http\Controllers\RoleController@index');
        Route::post('/role', 'App\Http\Controllers\RoleController@create');
        Route::get('/role/{id}', 'App\Http\Controllers\RoleController@show');
        Route::put('/role/{id}', 'App\Http\Controllers\RoleController@update');
        Route::delete('/role/{id}', 'App\Http\Controllers\RoleController@delete');

        // R for Modules
        Route::get('/modules', 'App\Http\Controllers\ModuleController@index');

        // CRUD for News
        Route::get('/news', 'App\Http\Controllers\NewsController@index');
        Route::get('/news/{id}', 'App\Http\Controllers\NewsController@show');
        Route::post('/news', 'App\Http\Controllers\NewsController@create');
        Route::put('/news/{id}', 'App\Http\Controllers\NewsController@update');
        Route::delete('/news/{id}', 'App\Http\Controllers\NewsController@delete');
        
        // CRUD for News Constructor
        Route::get('/constructor', 'App\Http\Controllers\ConstructorController@index');
        Route::post('/constructor', 'App\Http\Controllers\ConstructorController@update');

        // CRUD for Templates
        Route::get('/templates', 'App\Http\Controllers\TemplateController@index');
        Route::get('/template/{id}', 'App\Http\Controllers\TemplateController@show');
        Route::post('/template', 'App\Http\Controllers\TemplateController@create');
        Route::put('/template/{id}', 'App\Http\Controllers\TemplateController@update');
        Route::delete('/template/{id}', 'App\Http\Controllers\TemplateController@delete');

        // CRUD for Authors
        Route::get('/authors', 'App\Http\Controllers\AuthorController@index');
        Route::get('/author/{id}', 'App\Http\Controllers\AuthorController@show');
        Route::post('/author', 'App\Http\Controllers\AuthorController@create');
        Route::put('/author/{id}', 'App\Http\Controllers\AuthorController@update');
        Route::delete('/author/{id}', 'App\Http\Controllers\AuthorController@delete');

        // CRUD for Categories
        Route::get('/categories', 'App\Http\Controllers\CategoryController@index');
        Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@show');
        Route::post('/category', 'App\Http\Controllers\CategoryController@create');
        Route::put('/category/{id}', 'App\Http\Controllers\CategoryController@update');
        Route::delete('/category/{id}', 'App\Http\Controllers\CategoryController@delete');

        // CRUD for Tags
        Route::get('/tags', 'App\Http\Controllers\TagController@index');
        Route::get('/tag/{id}', 'App\Http\Controllers\TagController@show');
        Route::post('/tag', 'App\Http\Controllers\TagController@create');
        Route::put('/tag/{id}', 'App\Http\Controllers\TagController@update');
        Route::delete('/tag/{id}', 'App\Http\Controllers\TagController@delete');

        // R for Activity Log
        Route::get('/activitylogs', 'App\Http\Controllers\ActivityLogController@index');
        Route::get('/activitylog/{id}', 'App\Http\Controllers\ActivityLogController@show');

        // CRUD for Insets
        Route::get('/insets', 'App\Http\Controllers\InsetController@index');
        Route::get('/inset/{id}', 'App\Http\Controllers\InsetController@show');
        Route::post('/inset', 'App\Http\Controllers\InsetController@create');
        Route::put('/inset/{id}', 'App\Http\Controllers\InsetController@update');
        Route::delete('/inset/{id}', 'App\Http\Controllers\InsetController@delete');

         // CRUD for Insets
        Route::get('/inset_contents', 'App\Http\Controllers\InsetContentController@index');
        Route::get('/inset_content/{id}', 'App\Http\Controllers\InsetContentController@show');
        Route::post('/inset_content', 'App\Http\Controllers\InsetContentController@create');
        Route::put('/inset_content/{id}', 'App\Http\Controllers\InsetContentController@update');
        Route::delete('/inset_content/{id}', 'App\Http\Controllers\InsetContentController@delete');

         // CRUD for Joke Import
        Route::get('/joke_imports', 'App\Http\Controllers\JokeImportController@index');
        Route::put('/joke_import/{id}', 'App\Http\Controllers\InsetContentController@update');
        Route::delete('/joke_import/{id}', 'App\Http\Controllers\InsetContentController@delete');

         // CRUD for Quote Import
        Route::get('/quote_imports', 'App\Http\Controllers\QuoteImportController@index');
        Route::put('/quote_import/{id}', 'App\Http\Controllers\InsetContentController@update');
        Route::delete('/quote_import/{id}', 'App\Http\Controllers\InsetContentController@delete');
    
        // CRUD for Pages
        Route::get('/pages', 'App\Http\Controllers\PageController@index');
        Route::post('/page', 'App\Http\Controllers\PageController@create');
        Route::get('/page/{id}', 'App\Http\Controllers\PageController@show');
        Route::put('/page/{id}', 'App\Http\Controllers\PageController@update');
        Route::delete('/page/{id}', 'App\Http\Controllers\PageController@delete');

        // R for InsetStats
        Route::get('/insets_stats', 'App\Http\Controllers\InsetStatController@index');
        Route::get('/insets_charts', 'App\Http\Controllers\InsetStatController@charts');
        
        // R for NewsStats
        Route::get('/news_stats', 'App\Http\Controllers\NewsStatController@index');
        Route::get('/news_charts', 'App\Http\Controllers\NewsStatController@charts');
        
    });
});

Route::prefix('v1/app')->group(function () {
    // R for News
    Route::get('/news', 'App\Http\Controllers\Web\NewsController@index');
    Route::get('/news/{uri}', 'App\Http\Controllers\Web\NewsController@show');
    Route::post('/news_stat/{id}', 'App\Http\Controllers\Web\NewsController@update');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/preview/{id}', 'App\Http\Controllers\Preview\NewsController@show');
    });

    // R for Authors
    Route::get('/authors', 'App\Http\Controllers\AuthorController@index');
    Route::get('/author/{id}', 'App\Http\Controllers\AuthorController@show');

    // R for Categories
    Route::get('/categories', 'App\Http\Controllers\CategoryController@index');
    Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@show');

    // R for Tags
    Route::get('/tags', 'App\Http\Controllers\TagController@index');
    Route::get('/tag/{id}', 'App\Http\Controllers\TagController@show');

    // R for Reactions
    Route::post('/reaction', 'App\Http\Controllers\ReactionController@create');

    // R for Insets
    Route::get('/insets', 'App\Http\Controllers\InsetController@index');
    
    // R for InsetStats
    Route::post('/inset_stat', 'App\Http\Controllers\InsetStatController@create');

    // R for Weather
    Route::get('/weather', 'App\Http\Controllers\InsetWeatherController@index');
    
    // R for Weather Cities
    Route::get('/weather_cities', 'App\Http\Controllers\InsetWeatherCityController@index');

    // R for Currency
    Route::get('/currency', 'App\Http\Controllers\InsetCurrencyController@index');
    
    // R for Horoscope
    Route::get('/horoscope', 'App\Http\Controllers\InsetHoroscopeController@show');

    // R for Horoscope Signs
    Route::get('/horoscope_signs', 'App\Http\Controllers\InsetHoroscopeSignController@index');

    // R for Insets
    Route::post('/insets/image', 'App\Http\Controllers\InsetController@imageCreate');

    // R for Page
    Route::get('/page/{uri}', 'App\Http\Controllers\Web\PageController@show');
});