<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Installer Routes
|--------------------------------------------------------------------------
|
| All installer routes is here
|
|
*/

Route::group(['namespace'=>'Installer'],function(){
    Route::get('install','InstallerController@index')->name('install');
    Route::get('install/configuration','InstallerController@configuration')->name('install.configuration');
    Route::get('install/verify','InstallerController@verify')->name('install.verify');
    Route::post('verify_check','InstallerController@verify_check')->name('install.verify_check');
    Route::get('install/complete','InstallerController@complete')->name('install.complete');
    Route::post('install/store','InstallerController@send')->name('install.store');
    Route::get('install/check','InstallerController@check')->name('install.check');
    Route::get('install/migrate','InstallerController@migrate')->name('install.migrate');
    Route::get('install/seed','InstallerController@seed')->name('install.seed');
    Route::get('404',function(){
        return abort(404);
    })->name(404);
});

Route::get('google', 'AuthController@redirectToGoogle')->name('social.google');
Route::get('google/callback', 'AuthController@handleGoogleCallback')->name('social.googlecallback');

Route::get('facebook', 'AuthController@redirectToFacebook')->name('social.facebook');
Route::get('facebook/callback', 'AuthController@handleFacebookCallback')->name('social.facebookcallback');

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

//Auth routes
Route::post('post-login', 'AuthController@postLogin')->name('postlogin');
Route::post('post-register', 'AuthController@postRegister')->name('postregister');
Route::get('logout', 'AuthController@logout')->name('logout');
//Site route HomeController
Route::get('/cron', 'CronjobController@cronQuestion');
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/questions', 'HomeController@questions')->name('home.questions');
Route::get('/question/{name}', 'HomeController@question')->name('home.question');
Route::get('/categories/{name}', 'HomeController@categories')->name('home.category');
Route::get('/badges', 'HomeController@badges')->name('home.badges');
Route::get('/categories', 'HomeController@category')->name('home.categories');
Route::get('/users', 'HomeController@listUsers')->name('home.users');
Route::get('/notifications', 'HomeController@notifications')->name('home.notifications')->middleware('auth');;
Route::post('/deletenotify', 'HomeController@deletenotify')->name('home.deletenotify');
Route::get('/questions/ask', 'HomeController@question_ask')->name('questions.ask')->middleware('auth');
Route::get('/questions/edit/{id}', 'HomeController@question_edit')->name('home.questions.edit')->middleware('auth');
Route::get('/profile/{id}-{name}', 'HomeController@profile')->name('user.profile');
Route::get('/profile/{id}-{name}/activity', 'HomeController@profile_activity')->name('user.profile.activity');
Route::get('/profile/{id}/edit', 'HomeController@profile_edit')->name('user.profile.edit')->middleware('auth');;
Route::get('/page/{slug}', 'HomeController@page')->name('home.page');
Route::get('/blogs', 'HomeController@blogs')->name('home.blogs');
Route::get('/blogs/detail/{name}', 'HomeController@blogsDetail')->name('home.blogsDetail');
Route::get('/tags/{name}', 'HomeController@tags')->name('home.tags');

//Site route AjaxController
Route::post('/getnotify', 'AjaxController@getnotify')->name('home.getnotify');
Route::get('/getlistuser', 'AjaxController@get_ajax_user')->name('home.getlistuser');
Route::post('/getData', 'AjaxController@getData')->name('ajax.getData');
Route::post('/load_question', 'AjaxController@load_question')->name('home.loadquestion');
Route::post('/load_awnser', 'AjaxController@load_awnser')->name('home.loadawnser');
Route::post('/search_question', 'AjaxController@get_search')->name('home.search_question');
Route::post('/postquestion', 'AjaxController@postQuestion')->name('home.postquestion');
Route::post('/updatequestion', 'AjaxController@updatequestion')->name('home.updatequestion');
Route::post('/post_puestion_reply', 'AjaxController@PostQuestionReply')->name('home.postquestionreply');
Route::post('/postAnswer', 'AjaxController@postAnswer')->name('home.postAnswer');
Route::post('/postImagesToEmbed', 'AjaxController@postImagesToEmbed')->name('question.postImagesToEmbed');
Route::post('/postProfile', 'AjaxController@postProfile')->name('user.postProfile');
Route::get('/get_activity', 'AjaxController@get_activity')->name('user.get_activity');
Route::get('/get_ajax_cate_question', 'AjaxController@get_ajax_cate_question')->name('home.get_ajax_cate_question');
Route::get('/cate_getdata', 'AjaxController@get_ajax_cate')->name('home.cate_getdata');

//Admin routes
Auth::routes();
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    // Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    // Logout route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    // Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
    // Password reset routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::resource('/pages', 'PageController');
    Route::resource('/news', 'NewsController');
    Route::get('/pageorder', 'PageController@order');
    Route::resource('/questions', 'QuestionsController');
    Route::get('/get_ajax_data', 'QuestionsController@get_ajax_data')->name('admin.getappdata');
    Route::delete('/deletequestion/{id}', 'QuestionsController@destroy')->name('questions.destroy');
    Route::post('/ajax_update_question', 'QuestionsController@updatequestion')->name('admin.updatequestion');
    Route::resource('/users', 'UsersController');
    Route::get('/get_ajax_user', 'UsersController@get_ajax')->name('admin.getuser');
    Route::post('/ajax_update_user', 'UsersController@updateuser')->name('admin.updateuser');
    Route::get('/settings', 'SettingController@index');
    Route::post('/settings', 'SettingController@update');
    Route::get('/account_settings', 'SettingController@accountsettingsform');
    Route::post('/account_settings', 'SettingController@accountsettings')->name('accountsettings');
    Route::resource('/news', 'NewsController');
    Route::resource('/ads', 'AdController');
    Route::get('/sitemap', 'SettingController@siteMap')->name('admin.siteMap');
    Route::get('/genSitemap', 'SettingController@genSitemap')->name('admin.genSitemap');
    Route::get('/reportQuestion', 'QuestionsController@reportQ')->name('admin.reportQuestion');
    Route::get('/reportAnswer', 'QuestionsController@reportA')->name('admin.reportAnswer');
    Route::resource('/categories', 'CategoriesController');
    Route::post('/ajax_get_cate', 'CategoriesController@getcate')->name('admin.getcate');
    Route::post('/ajax_add_cate', 'CategoriesController@addcate')->name('admin.addcate');
    Route::post('/postReport', 'QuestionsController@postReport')->name('admin.postReport');
    Route::get('/home', 'AdminController@home');
    Route::post('/homeUpdate', 'AdminController@update');
});
