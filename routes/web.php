<?php

use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AgentController;


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

Route::redirect('/','signin');
Route::get('/signin',[userController::class,'signin']);
Route::get('/signup',[userController::class,'signup']);

Route::post('/signin',[userController::class,'do_signin'])->name('signin');
Route::post('/signup',[userController::class,'do_signup'])->name('signup');

Route::get('/logout',[userController::class,'logout'])->name('logout');

// Route::get('/dashboard',[userController::class,''])
Route::middleware(['role'])->group(function(){
    //dashboard
    Route::get('/dashboard',[dashboardController::class,'index'])->name('dashboard');
    Route::resource('/ticket',TicketController::class);
    Route::post('ticket/status',[TicketController::class,'change_status'])->name('ticket.status');
    Route::post('ticket/agent/update',[TicketController::class,'update_agent'])->name('ticket.agent_update');
    Route::get('/services',[ServicesController::class,"index"]);
    Route::post('/reply/store',[TicketController::class,'store_reply'])->name('reply.store');
    Route::resource('/email',EmailController::class);
    Route::resource('/question',QuestionController::class);
    Route::resource('/agent',AgentController::class);
    Route::post('/agent/delete',[AgentController::class,"delete"])->name('agent.delete');
    Route::post('/question/delete',[QuestionController::class,"delete"])->name('question.delete');
    Route::post('/question/search',[QuestionController::class,"search"])->name('question.search');
});


