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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/home', 'HomeController@redirectToDashboard')->name('redirect_to_dashboard')->middleware('auth');

//Guest Routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/team/{team}', 'TeamController@show')->name('team');
Route::get('/agenda', 'AgendaController@index')->name('agenda');
Route::get('/agenda-events-ajax', 'AgendaController@agendaEvents')->name('agenda_events_ajax');
Route::get('/events-ajax', 'EventsController@eventsAjax')->name('events_ajax');
Route::get('/events', 'EventsController@index')->name('events');
Route::get('/live-ticker', 'LiveTickerController@index')->name('live_ticker');
Route::get('/live-ticker/matches', 'LiveTickerController@matches')->name('live_ticker_matches');
Route::get('/live-ticker/{id}', 'LiveTickerController@show')->name('live_ticker_details');
Route::get('/news', 'NewsController@index')->name('news');
Route::get('/contact-us', 'ContactUsController@index')->name('contact_us');

// Admin Routes
Route::get('/dashboard', 'AdminController@index')->name('dashboard');

//Agenda Management
Route::get('/agenda/add', 'AgendaController@agendaEventsCreate')->name('agenda_events_create')->middleware('auth');
Route::post('/agenda/store', 'AgendaController@store')->name('agenda_events_store')->middleware('auth');
Route::get('/agenda/manage', 'AgendaController@agendaEventsManage')->name('agenda_events_manage')->middleware('auth');
Route::get('/agenda/update', 'AgendaController@update')->name('agenda_events_update')->middleware('auth');

//Event Management
Route::get('/events/add', 'EventsController@eventsCreate')->name('events_create')->middleware('auth');
Route::post('/events/store', 'EventsController@store')->name('events_store')->middleware('auth');
Route::get('/events/manage', 'EventsController@eventsManage')->name('events_manage')->middleware('auth');
Route::get('/events/manage/{id}', 'EventsController@show')->name('events_manage_show')->middleware('auth');
Route::post('/events/update', 'EventsController@update')->name('events_update')->middleware('auth');

//Team Management
Route::get('/teams/add', 'TeamController@teamCreate')->name('teams_create')->middleware('auth');
Route::post('/teams/store', 'TeamController@store')->name('teams_store')->middleware('auth');
Route::get('/teams/manage', 'TeamController@teamManage')->name('teams_manage')->middleware('auth');
Route::post('/teams/update', 'TeamController@update')->name('teams_update')->middleware('auth');

//Player Management
Route::get('/players/add', 'PlayerController@playersCreate')->name('players_create')->middleware('auth');
Route::post('/players/store', 'PlayerController@store')->name('players_store')->middleware('auth');
Route::get('/players/manage', 'PlayerController@playersManage')->name('players_manage')->middleware('auth');
Route::post('/players/update', 'PlayerController@update')->name('players_update')->middleware('auth');



