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

Route::get('/', function () {
    return view('welcome');
});
// Thread
Route::get('/', 'ThreadController@index')->name('threads.index');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show')->middleware('filter');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::post('/threads', 'ThreadController@store')->name('threads.store');
Route::delete('/threads/{channel}/{thread}', 'ThreadController@destroy')->name('threads.delete');
Route::get('/threads', 'ThreadController@getData');
Route::get('/threads/search', 'SearchController@show')->name('search');
// Reply
Route::get('/threads/{channel}/{thread}/replies', 'ReplyController@index');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::patch('replies/{reply}', 'ReplyController@update')->name('replies.update');
Route::delete('/replies/{reply}', 'ReplyController@destroy')->name('replies.delete');

// Channel
Route::get('/threads/{channel}', 'ChannelController@index')->name('channels.index');
Route::post('channels', 'ChannelController@store')->name('channels.store');

// Favorite
Route::post('/replies/{reply}/favorites', 'FavoriteController@store')->name('like');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy')->name('unlike');

// Profile

Route::get('/profile/{user}', 'ProfileController@show')->name('profile.show');
Route::get('/profile/{user}/questions', 'ProfileController@show')->name('profile.questions');
Route::get('/profile/{user}/answers', 'ProfileController@show')->name('profile.answers');
Route::get('/profile/{user}/favorites', 'ProfileController@show')->name('profile.favorites');
Route::get('/profile/{user}/histories', 'ProfileController@show')->name('profile.histories');

Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('/profile/{user}', 'ProfileController@update')->name('profile.update');
// Notification

Route::get('/profile/{user}/notifications', 'UserNotificationController@index');
Route::delete('/profile/{user}/notifications/{notification}', 'UserNotificationController@destroy');

// Tag

Route::get('/tags/{tag}', 'TagController@index')->name('tags.index');

//User

Route::get('/user/search', 'UserController@search');
Route::get('/users', 'UserController@getUser');

//Contact

Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::post('/contact', 'ContactController@store')->name('contact.store');
// Auth
Auth::routes();

Route::view('scan', 'search');

Route::get('/123', 'Admin\ThreadController@test');

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
