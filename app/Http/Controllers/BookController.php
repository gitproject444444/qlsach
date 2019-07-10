<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Http\Requests\BookRequest;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['books'] = Book::with('author')->paginate(5);
        $data['authors'] = Author::all();
        return view('admin.books',$data);
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
        return redirect()->back()->with('message',"thêm sách $book->name thành công");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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
        if($request->namebook){
            $name = $request->namebook;
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
        }

    }




}
