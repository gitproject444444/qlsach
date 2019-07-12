<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Http\Requests\CreateAuthorRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['authors'] = Author::paginate(5);
        return view('admin.authors', $data);
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
    public function store(CreateAuthorRequest $request)
    {
        $name = $request->name;
        $author = Author::create([
            'name' => $name
        ]);
        // return 'success';
        return redirect()->route('admin.authors.index')->with('message', "thêm sách $author->name thành công");
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
        $author = Author::findOrFail($id);
        $books = $author->books;
        foreach ($books as $book) {
            $book->delete();
        }
        $author->delete();
        return redirect()->route('admin.authors.index')->with('message', "Đã tác giả $author->name");
    }
    public function changeauthor(Request $request)
    {

        $name = $request->author;
        $oldauthor = Author::where('name', $name)->first();
        if (!$oldauthor) {
            $authorName = $request->author;
            $id = $request->id;
            $author = Author::findOrFail($id);
            $author->name = $authorName;
            $author->save();
            return 'update success!!!';
        } else {
            return 'update trùng!!!';
        }
    }
}
