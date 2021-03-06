<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//when authentication failed, user redirect to login route automatically
//hadi i cant speak persian , please speak english namoosan
Route::get('/login', 'admin\UserController@login')->name('login');
Route::get('/authenticate', 'admin\UserController@authenticate')->name('authenticate');
Route::post('/article/{id}/comment', 'Admin\CommentController@store')->name('frontend.comment.store');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {


    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

    //set Auth middleware for Prevent access to Admin pages without login
    Route::get('/articles', 'ArticleController@index')->name('admin.articles.list');
    Route::get('/addArticle', 'ArticleController@addArticle')->name('article.addArticle');
    Route::post('/addArticle', 'ArticleController@storeArticle')->name('article.storeArticle');
    Route::get('/editArticle/{id}', 'ArticleController@edit')->name('admin.article.edit');
    Route::post('/editArticle/{id}', 'ArticleController@update')->name('admin.article.update');
    Route::get('/deleteArticle/{id}', 'ArticleController@delete')->name('admin.article.delete');


    //comments routes
    Route::get('/comments', 'CommentController@index')->name('admin.comments.list');
    Route::get('/comments/verify/{id}/{flag}', 'CommentController@verify')->name('admin.comments.verify');
    Route::get('/comments/singleshow/{id}', 'CommentController@singleshow')->name('admin.comments.singleshow');
    Route::post('/comments/answer/{id}', 'CommentController@answer')->name('admin.comments.answer');
    Route::get('/comments/edit/{id}', 'CommentController@edit')->name('admin.comments.edit');
    Route::post('/comments/update/{id}', 'CommentController@update')->name('admin.comments.update');
    Route::get('/comments/remove/{id}', 'CommentController@remove')->name('admin.comments.remove');


    Route::get('/articles', 'ArticleController@index')->name('admin.articles.list');
    Route::get('/addArticle', 'ArticleController@addArticle')->name('article.addArticle');
    Route::post('/addArticle', 'ArticleController@storeArticle')->name('article.storeArticle');
    Route::get('/editArticle/{id}', 'ArticleController@edit')->name('admin.article.edit');
    Route::post('/editArticle/{id}', 'ArticleController@update')->name('admin.article.update');
    Route::get('/deleteArticle/{id}', 'ArticleController@delete')->name('admin.article.delete');


    //categories routes
    Route::get('/categories', 'CategoryController@index')->name('admin.categories.list');
    Route::get('/categories/create', 'CategoryController@create')->name('admin.categories.create');
    Route::post('/categories/create', 'CategoryController@store')->name('admin.categories.store');
    Route::get('/categories/edit/{category_id}', 'CategoryController@edit')->name('admin.categories.edit');
    Route::post('/categories/edit/{category_id}', 'CategoryController@update')->name('admin.categories.update');
    Route::get('/categories/remove/{category_id}', 'CategoryController@remove')->name('admin.categories.remove');

    //tags routes
    Route::get('/tags', 'TagController@index')->name('admin.tags.list');
    Route::get('/tags/create', 'TagController@create')->name('admin.tags.create');
    Route::post('/tags/create', 'TagController@store')->name('admin.tags.store');
    Route::get('/tags/edit/{tag_id}', 'TagController@edit')->name('admin.tags.edit');
    Route::post('/tags/edit/{tag_id}', 'TagController@update')->name('admin.tags.update');
    Route::get('/tags/remove/{tag_id}', 'TagController@remove')->name('admin.tags.remove');

});

Route::group(['namespace' => 'Frontend'], function () {

    //articles routes
    Route::get('/articles', 'ArticleController@index')->name('frontend.articles.list');
    Route::get('/articles/{id}', 'ArticleController@single')->name('frontend.articles.single');

});
