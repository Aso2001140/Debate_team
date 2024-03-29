<?php


use App\Http\Controllers\allController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\GenreController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;


/*;
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//チャット機能
Route::post('/chat/{rid}/{state}',[ChatController::class,'store'])->name('chat');

//ディベートのジャンル選択ページ
Route::get('/sgenre',[GenreController::class,'index']);
//待機室から抜けてジャンル選択に戻る(部屋から離脱する)
Route::get('/sgenre/{roomid}/{state}/{userid}',[GenreController::class,'exit_from_waiting_room']);
//ルーム選択
Route::get('/stheme/{id}',[ThemeController::class,'index']);
//待機室から抜けてルーム画面にも戻る(部屋から離脱する)
Route::get('/stheme/{roomid}/{state}/{userid}',[ThemeController::class,'exit_from_waiting_room'])->name('exitwaitroom');
Route::get('/createdtheme',[ThemeController::class,'userindex']);
//チャットページ(待機画面から)
Route::get('/chat/{rid}/{state}',[ChatController::class,'index']);

//laravel のホーム画面
Route::get('/home', [HomeController::class, 'index'])->name('home');

//getData(ajax)
Route::get('/chat/{rid}/result/ajax',[ChatController::class,'getData']);
Route::get('/chat/{rid}/result/ajax/chat_data',[ChatController::class,'getDataSize']);

//待機画面ルート
Route::get('standby/',[RoomController::class,'waituser2']);
Route::get('standby/{rid}/{state}',[RoomController::class,'waituser']);
//規定人数がいるかどうかを聞く
Route::get('/check/{rid}/{state}',[RoomController::class,'confirmation']);

//投票機能
//投票画面
Route::get('/vote',[VoteController::class,'index']);
//投票集計(Ajax)
Route::post('/vote/sum',[VoteController::class,'VoteCounting']);
//投票結果
Route::get('/vote/result',[VoteController::class,'VoteResult']);

//all機能
Route::get('/all',[allController::class,'index']);

//mypage機能
Route::get('/mypage',[\App\Http\Controllers\MypageController::class,'index']);
Route::get('/readme',[GenreController::class,'readme']);
Route::get('/ranking',[\App\Http\Controllers\RankingController::class,'index']);
Route::get('/delroom',[\App\Http\Controllers\DelController::class,'index']);
Route::get('/delroom/{rid}',[\App\Http\Controllers\DelController::class,'del']);

//ユーザー定義のルームページ
Route::get('/userroom',[RoomController::class,'userroom']);
//ルーム作成submit
Route::post('/userroom/create',[RoomController::class,'create']);

//ランキング一覧
Route::get('/ranking',[\App\Http\Controllers\RankingController::class,'index']);

//ルート変更
//一番最初にreadmeページを開く
Route::get('/',[GenreController::class,'index']);
//ログインボタンを押下
Auth::routes();

//管理者ログイン画面に遷移
Route::get('/root',function(){
     return view('adminLogin');
});


// 管理者画面の「お題作成」ボタンを押下したとき
Route::get('/addTitle/{adminName}',[\App\Http\Controllers\TitleController::class,'index']);
// お題作成ページの「登録ボタンを押下したとき
Route::post('/titleInsert',[\App\Http\Controllers\TitleController::class,'titleInsert']);

// 管理者画面の「ルーム一覧」ボタンを押下したとき
Route::get('/roomAll',[\App\Http\Controllers\RoomAllController::class,'index']);
// 管理者画面の「チャット時間の編集」ボタンを押下したとき
Route::get('/timeChange',[\App\Http\Controllers\TimeChangeController::class,'index']);
// 管理者画面の「NGワード編集」ボタンを押下したとき
Route::get('/ngwordEdit',[AdminController::class,'ngwordView']);
// Ng画面の「削除」ボタンを押下したとき
Route::post('/ngDelete',[\App\Http\Controllers\NgController::class,'destroy']);
// Ngword編集画面で「登録ボタン」を押下したとき
Route::get('/ngwordEdit/insert',[\App\Http\Controllers\AdminController::class,'ngwordInsert']);


//管理者ログイン画面の[Do you have an admin acount?]ボタンを押下時
Route::get('/adminNewAcount',[\App\Http\Controllers\AdminController::class,'newAcountView']);

//管理者アカウント作成画面の「make acount」ボタンを押下したとき
Route::post('/makeAcount',[\App\Http\Controllers\AdminController::class,'makeAdminAcount']);
//管理者ログイン画面のloginを押下時
Route::post('/admin',[\App\Http\Controllers\AdminController::class,'login']);

// 管理者画面の「ルーム一覧」ボタンを押下したとき
Route::get('/roomAll',[\App\Http\Controllers\RoomAllController::class,'index']);
// 管理者画面の「チャット時間の編集」ボタンを押下したとき
Route::get('/timeChange',[\App\Http\Controllers\TimeChangeController::class,'index']);

// 管理者画面の「ルーム一覧」のボタンを押下したとき
Route::post('/roomAlls',[\App\Http\Controllers\RoomAllController::class,'serach']);
