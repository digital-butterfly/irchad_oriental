<?php

use Illuminate\Support\Facades\Route;

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
// Route to la page d'accueil
Route::get('/', function () {
    return view('front-office.welcome');
});
//route vers la page programme
Route::get('/programme', function () {
    return view('front-office.programme');
});
//route vers la page soummisions projet
Route::get('/project-submission','CandidatureController@index');
Route::get('/adherent', function () {
    return view('adherent');
});
//route vers la page à propos
Route::get('/a-propos',function(){
    return view('front-office.about-us');
});
//route vers la page formation
Route::get('/formation',function(){
    return view('front-office.formation');
});
//route vers la page cantact
Route::get('/contact',function(){
    return view('front-office.contact');
});
//route vers la page cantact
Route::get('/faq',function(){
    return view('front-office.faq');
});
//route vers ajout de soummision projets
Route::post("/project-submission",'CandidatureController@create')->name("projectSubmission");
Route::post('/', 'Auth\LoginController@userLogin');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/admin', 'Auth\LoginController@showUserLoginForm')->name('login.admin');
Route::get('/login/member', 'Auth\LoginController@showMemberLoginForm')->name('login.member');
Route::get('/register/admin', 'Auth\RegisterController@showUserRegisterForm')->name('register.admin');
Route::get('/register/member', 'Auth\RegisterController@showMemberRegisterForm')->name('register.member');


Route::post('/login/admin', 'Auth\LoginController@userLogin');
Route::post('/login/member', 'Auth\LoginController@memberLogin');
Route::post('/register/admin', 'Auth\RegisterController@createUser')->name('register.admin');
Route::post('/register/member', 'Auth\RegisterController@createMember')->name('register.member');


Route::view('/home', 'home')->middleware('auth');


Route::group(['middleware' => 'auth:user'], function () {

    // Route::view('/admin', 'back-office/home');

    Route::resource('admin/users', 'UserController');
    Route::post('/admin/list/users', 'UserController@ajaxList');

    Route::resource('admin/communes', 'TownshipController');
    Route::post('/admin/list/communes', 'TownshipController@ajaxList');

    Route::resource('admin/fiches-projets', 'ProjectSheetController');
    //Route::post('/admin/list/fiches-projets', 'ProjectSheetController@ajaxList');

    Route::resource('admin/members', 'MemberController');
    Route::post('/admin/list/members', 'MemberController@ajaxList');

    Route::resource('admin/candidatures', 'ProjectApplicationController');
    Route::post('/admin/list/candidatures', 'ProjectApplicationController@ajaxList');

    Route::resource('admin/formation', 'FormationController');
    Route::post('/admin/list/Formation', 'FormationController@ajaxList');
    route::post('/admin/FormationList', 'SessionController@ajaxFormationList');

    Route::resource('admin/session', 'SessionController');
    Route::resource('admin/session/all-calendar', 'SessionController@allcalendar');
    Route::post('/admin/list/session', 'SessionController@ajaxList');


    Route::resource('admin/session-members', 'AdherentSessionController');
    Route::post('/admin/list/adherentsession', 'AdherentSessionController@ajaxList');
    Route::post('/admin/list/adherentsess', 'AdherentSessionController@ajaxListAdhSess');

    Route::post('/admin/list/projectadherentsess', 'ProjectApplicationController@ajaxListAdhSess');
    Route::post('/admin/list/projectAppMembers', 'ProjectApplicationController@ajaxListProjectMembers');



    Route::post('/admin/projectList', 'SessionController@ajaxProjectList');
    Route::post('/admin/MemebersProjectList', 'SessionController@ajaxMemebersProjectList');


    route::post('/admin/candidaturesmemmbers', 'ProjectApplicationController@ajaxMembersList');
    route::post('/admin/sessionFormation', 'ProjectApplicationController@ajaxSessionList');


    Route::resource('admin/', 'DashboardController');
    Route::get('admin', 'DashboardController@ajaxList');

    Route::get('/admin/exportExl','ExportController@exportExl')->name('exportExl');



    Route::resource('admin/projects-categories', 'ProjectCategoryController');

});
    Route::get('/admin/exportExcel','ProjectApplicationController@exportExcel')->name('exportExcel');
    Route::get('/admin/exportExcelmembers','MemberController@exportExcel')->name('exportExcel');


Route::group(['middleware' => 'auth:member'], function () {
    Route::view('/member', 'member-office/home');
});
