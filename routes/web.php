<?php

use App\Http\Controllers\Admin\Chat\ChatController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Login\LoginController;
use App\Http\Controllers\Admin\Visitor\VisitorController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin.dashboard.index');
// });

Route::get('/', function () {
    return redirect()->to('logins');
});

Route::get('optimize',function(){
    Artisan::call('optimize');
    return "Optimized";
});
Route::get('optimize:clear',function(){
    Artisan::call('optimize:clear');
    return "Optimized-cleared";
});
Route::get('config-clear',function(){
    Artisan::call('config:clear');
    return "config-clear";
});


Route::get('/logins',[LoginController::class,'login'])->name('login');
Route::get('/admin',function(){
    return redirect()->route('login');
});
Route::post('/login',[LoginController::class,'checkLogin']);

// Prevent admin from login page after logged In!
Route::get('/login',function(){
    if(Auth::user() == null){
        return redirect()->route('login');
    }else{
        return redirect()->route('home');
    }
});

Route::get('/register',[LoginController::class,'register']);
Route::post('/register',[LoginController::class,'storeRegister']);


Route::group(['middleware' => 'auth'],function(){

    // Chat Routes
    Route::get('/dashboard',[DashboardController::class,'index'])->name('home');

    // Chat Routes
    Route::controller(ChatController::class)->group(
        function(){
            Route::get('/chats','index');
            Route::post('/check-message','checkMessage')->name('checkMessage');
            Route::post('fetch-visitor-info','getVisitorInfo')->name('fetch-visitor-info');
        }
    );

    Route::controller(VisitorController::class)->group(
        function(){
            Route::get('live-visitor','VisitorPage');
            Route::get('change-status/{id}','changeStatus');
        }
    );

    Route::get('/logout',function(){
        Auth::logout();
        return redirect()->route('login');
    });

});




Route::get('/sound',function(){
    return view('welcome');
});

Route::get('/ip',function(){
    return view('test.test');
});
Route::post('/local-visitor',[VisitorController::class,'index']);
Route::post('/local-send-message',[ChatController::class,'message'])->name('send-message');




Route::get('/tab',function(){
    return view('test.ontabclose');
});
Route::post('/tab-close',[ChatController::class,'tabClose']);



Route::get('/admin/vue-panel',function(){
    return view('vue-panel');
});
//e
