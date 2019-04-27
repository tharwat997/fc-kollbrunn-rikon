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
use Spatie\Honeypot\ProtectAgainstSpam;

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
Route::post('/comments/store', 'CommentController@store')->name('comments_store')->middleware(ProtectAgainstSpam::class);
Route::get('/news', 'PostsController@index')->name('news');
Route::get('/news/{id}', 'PostsController@show')->name('news_show');
Route::get('/contact-us', 'ContactUsController@index')->name('contact_us');
Route::get('/contact-us/events', 'ContactUsController@eventsAjax')->name('contact_us_events');

// Admin Routes
Route::get('/dashboard', 'AdminController@index')->name('dashboard');

//Agenda Management
Route::get('/agenda/add', 'AgendaController@agendaEventsCreate')->name('agenda_events_create')->middleware('auth');
Route::post('/agenda/store', 'AgendaController@store')->name('agenda_events_store')->middleware('auth');
Route::get('/agenda/manage', 'AgendaController@agendaEventsManage')->name('agenda_events_manage')->middleware('auth');
Route::post('/agenda/update', 'AgendaController@update')->name('agenda_events_update')->middleware('auth');

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

//Board members Management
Route::get('/board/add', 'BoardMemberController@boardCreate')->name('board_create')->middleware('auth');
Route::post('/board/store', 'BoardMemberController@store')->name('board_store')->middleware('auth');
Route::get('/board/manage', 'BoardMemberController@boardManage')->name('board_manage')->middleware('auth');
Route::post('/board/update', 'BoardMemberController@update')->name('board_update')->middleware('auth');

// Ticker Management - Match
Route::get('/match/add', 'LiveTickerController@matchCreate')->name('match_create')->middleware('auth');
Route::post('/match/store', 'LiveTickerController@matchStore')->name('match_store')->middleware('auth');
Route::get('/match/manage', 'LiveTickerController@matchesManage')->name('matches_manage')->middleware('auth');
Route::post('/match/update', 'LiveTickerController@matchUpdate')->name('match_update')->middleware('auth');

// Ticker Management - Match events
Route::get('/matches', 'LiveTickerController@matchesView')->name('matches')->middleware('auth');
Route::get('/matches/{id}/event/create', 'LiveTickerController@matchEventCreate')->name('match_event_create')->middleware('auth');
Route::post('/match/event/store', 'LiveTickerController@matchEventStore')->name('match_event_store')->middleware('auth');
Route::get('/matches/{id}/events', 'LiveTickerController@matchEvents')->name('matches_events')->middleware('auth');
Route::get('/matches/{matchId}/events/{eventId}/manage', 'LiveTickerController@matchEventsManage')->name('match_event_manage')->middleware('auth');
Route::get('/matches/{matchId}/events/{eventId}/delete', 'LiveTickerController@matchEventsDelete')->name('match_event_delete')->middleware('auth');
Route::post('/match/event/update', 'LiveTickerController@matchEventsUpdate')->name('match_event_update')->middleware('auth');
Route::post('/match/end/{id}', 'LiveTickerController@matchEnd')->name('match_end')->middleware('auth');

//News posts Management
Route::get('/post/add', 'PostsController@postCreate')->name('post_create')->middleware('auth');
Route::post('/post/store', 'PostsController@store')->name('post_store')->middleware('auth');
Route::get('/posts/manage', 'PostsController@postManage')->name('posts_manage')->middleware('auth');
Route::get('/posts/manage/{id}', 'PostsController@postManageShow')->name('posts_manage_show')->middleware('auth');
Route::post('/post/update', 'PostsController@update')->name('post_update')->middleware('auth');

//Messages Management
Route::post('/message/submit', 'MessageController@submit')->name('message_submit');
Route::get('/messages', 'MessageController@index')->name('messages')->middleware('auth');
Route::get('/message/view/{id}', 'MessageController@messageShow')->name('message_view')->middleware('auth');
Route::post('/message/update', 'MessageController@messageUpdate')->name('message_update')->middleware('auth');
Route::post('/message/update/assigned/user', 'MessageController@messageUpdateAssignedUser')->name('message_update_assigned_user')->middleware('auth');

// User management
Route::get('/user/add', 'UserController@userCreate')->name('user_create')->middleware('auth');
Route::post('/user/store', 'UserController@userStore')->name('user_store')->middleware('auth');
Route::get('/user/manage', 'UserController@userManage')->name('user_manage')->middleware('auth');
Route::post('/user/update', 'UserController@userUpdate')->name('user_update')->middleware('auth');



