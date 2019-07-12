<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/master', 'HomeController@master')->name('master');




Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'CheckRole'], function () {

    Route::resource('books', 'BookController');
    Route::resource('authors', 'AuthorController');
    Route::resource('users', 'UserController');
    Route::post('/changebook', 'BookController@changebook')->name('changebook');
    Route::post('/changeauthor', 'AuthorController@changeauthor')->name('changeauthor');
    Route::get('/trashs', 'TrashController@index')->name('trashs.index');
    Route::put('/restorebook/{id}', 'TrashController@restoreBook')->name('trashs.restorebook');
    Route::put('/restoreauthor/{id}', 'TrashController@restoreAuthor')->name('trashs.restoreauthor');
    Route::delete('/delCompletelyBook/{id}', 'TrashController@delCompletelyBook')->name('trashs.delcompletelybook');
    Route::delete('/delcompletelyauthor/{id}', 'TrashController@delCompletelyAuthor')->name('trashs.delcompletelyauthor');
    Route::delete('/delallbook', 'TrashController@delAllBook')->name('trashs.delallbook');
    Route::delete('/delallauthor', 'TrashController@delAllAuthor')->name('trashs.delallauthor');

});
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth'], function () {

    // Route::resource('books', 'BookController');
    // Route::resource('authors', 'AuthorController');
    // Route::resource('users', 'UserController');
    // Route::post('/changebook', 'BookController@changebook')->name('changebook');
    // Route::post('/changeauthor', 'AuthorController@changeauthor')->name('changeauthor');
    Route::get('/borrow', 'BookController@borrowindex')->name('borrow.index');
    Route::post('/borrow', 'BookController@borrow')->name('borrow.store');
    Route::get('/prepareborrow/{id}', 'BookController@prepareBorrow')->name('prepareborrow');
    Route::get('/watchbook/{id}', 'BookController@readbook')->name('watchbook');









    Route::get('/giveback/{id}', 'UserController@show')->name('giveback.index');
    Route::put('/giveback/{id}', 'UserController@giveback')->name('giveback.edit');
    // Route::put('/restorebook/{id}', 'TrashController@restoreBook')->name('trashs.restorebook');
    // Route::put('/restoreauthor/{id}', 'TrashController@restoreAuthor')->name('trashs.restoreauthor');
    // Route::delete('/delCompletelyBook/{id}', 'TrashController@delCompletelyBook')->name('trashs.delcompletelybook');
    // Route::delete('/delcompletelyauthor/{id}', 'TrashController@delCompletelyAuthor')->name('trashs.delcompletelyauthor');
    // Route::delete('/delallbook', 'TrashController@delAllBook')->name('trashs.delallbook');
    // Route::delete('/delallauthor', 'TrashController@delAllAuthor')->name('trashs.delallauthor');

});

view()->composer(['user.masteruser'], function ($view) {

    $user = User::find(Auth::id());
    if($user->status == 1){
        $books = $user->books;
        foreach($books as $book){
            if($book->pivot->status == 1){
                 $id = $book->id;
                 $view->with('bookborrow', $id);
            }
         }
}
});





