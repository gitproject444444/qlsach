<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $repository;
    public function __construct(Repositories\UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $users = User::paginate(5);
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function show($id)
    {
        $book = Book::find($id);
        return view('user.giveback', compact('book'));
    }

    public function giveback($id)
    {
        $user = User::find(Auth::id());
        $book = Book::find($id);
        $user->status = 0;
        $book->status = 0;
        $book->save();
        $user->save();
        $user->books()->updateExistingPivot($book, ['status' => 0]);
        return redirect()->route('user.borrow.index')->with('message', "Đã trả sách $book->name");
    }
}
