<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;
use App\Jobs\restoreBook;
use Carbon\Carbon;
use App\User;
use App\Http\Requests\BorrowRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('CheckBorrow')->only('prepareBorrow');
    }







    public function index()
    {
        $data['books'] = Book::with('author')->paginate(5);
        $data['booksw'] = Book::with('author')->where('status', 1)->paginate(5);
        $data['booksb'] = Book::with('author')->where('status', 2)->paginate(5);
        $data['booksf'] = Book::with('author')->where('status', 0)->paginate(5);
        $data['authors'] = Author::all();
        return view('admin.books', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $name = $request->name;
        $authorName = $request->author;
        $author = Author::firstOrCreate([
            'name' => $authorName,
        ], [
            'name' => $authorName,
        ]);
        $book = Book::create([
            'name' => $name,
            'author_id' => $author->id
        ]);
        return redirect()->back()->with('message', "thêm sách $book->name thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('admin.books.index')->with('message', "Đã xóa sách $book->name");
    }

    public function changebook(Request $request)
    {

        $name = $request->namebook;
        $oldbook = Book::where('name', $name)->first();
        if (!$oldbook) {
            $authorName = $request->author;
            $id = $request->id;
            $book = Book::findOrFail($id);
            $author = Author::firstOrCreate([
                'name' => $authorName,
            ], [
                'name' => $authorName,
            ]);
            $book->name = $name;
            $book->author_id = $author->id;
            $book->save();
            return 'update success!!!';
        } else {
            return 'update trùng!!!';
        }
    }

    public function borrowindex()
    {
        $books = Book::with('author')->where('status', 0)->paginate(5);
        return view('user.borrow', compact('books'));
    }




    public function prepareBorrow($id)
    {
        $userID = Auth::id();
        $book = Book::find($id);
        return view('user.prepare', compact('book'));
    }


    public function readbook($id)
    {

        $book = Book::findOrFail($id);
        $book->status = 1;
        $book->save();
        restoreBook::dispatch($id)
            ->delay(now()->addMinutes(1));
        return view('user.watch', compact('book'));
    }

    public function borrow(BorrowRequest $request)
    {
        $date = $request->date;
        $dt = Carbon::create($date);
        $today = Carbon::today();
        $diff = $dt->diffInDays($today);
        $userID = Auth::id();
        $bookID = $request->id;
        $user = User::findOrFail($userID);
        $book = Book::findOrFail($bookID);
        $user->status = 1;
        $book->status = 2;
        $book->save();
        $user->save();
        $book->users()->attach([$userID => ['pay' => $dt,'status' => 1]]);
        return redirect()->route('user.borrow.index')->with('message', "Đã mượn sách $book->name");
    }
}
