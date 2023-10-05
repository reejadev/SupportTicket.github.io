<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;

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

Route::get('/', function () {
   return view('welcome');
//    $users = DB::select("Select * from users");
//    dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::post('/profile/avatar/ai', [AvatarController::class, 'generate'])->name('profile.avatar.ai'); 

});

require __DIR__.'/auth.php';

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();    
})->name('login.github');

    Route::get('/auth/callback', function () {
        $user = Socialite::driver('github')->stateless()->user();
      $user = User::firstOrCreate(['email' => $user->email],[
        'name' => $user->name,
        'password' =>'password',
      ]);
      Auth::login($user);
      return redirect('/dashboard');
    });


    Route::middleware('auth')->group(function () {

        Route::resource('/ticket', TicketController::class);
        // Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
        // Route::post('/ticket/create', [TicketController::class, 'store'])->name('ticket.store');

    });
    Route::post('/replies', [ReplyController::class, 'store'])->name('replies.store');