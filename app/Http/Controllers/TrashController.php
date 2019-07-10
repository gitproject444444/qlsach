<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;

class TrashController extends Controller
{
    public function index()
    {
        $data['books'] = Book::onlyTrashed()->with('author')->paginate(3);
        $data['authors'] = Author::onlyTrashed()->get();
        return view('admin.trashs', $data);
    }

    public function restoreBook($id)
    {
        $book = Book::onlyTrashed()->where('id', $id)->first();
        $author = $book->author;
        if ($author->trashed()) {
            return redirect()->route('admin.books.index')->with('error', "Tác giả đã bị xóa");
        }
        $book->restore();
        return redirect()->route('admin.books.index')->with('message', "Khôi phục sách $book->name thành công");
    }

    public function restoreAuthor($id)
    {
        $author = Author::onlyTrashed()->where('id', $id)->first();
        $author->restore();
        return redirect()->route('admin.authors.index')->with('message', "Khôi phục tác giả $author->name thành công");
    }

    public function delCompletelyBook($id)
    {
        $book = Book::onlyTrashed()->where('id', $id)->first();
        $book->forceDelete();
        return redirect()->route('admin.trashs.index')->with('message', "Xóa vĩnh viễn sách $book->name thành công");
    }

    public function delCompletelyAuthor($id)
    {
        $author = Author::onlyTrashed()->where('id', $id)->first();
        $books = $author->books;
        foreach($books as $book){
          $book->forceDelete();
        }
        $author->forceDelete();
        return redirect()->route('admin.authors.index')->with('message', "Xóa vĩnh viễn tác giả $author->name thành công");
    }
    public function delAllBook()
    {
        $books = Book::onlyTrashed()->get();
        foreach($books as $book){
            $book->forceDelete();
        }
        return redirect()->route('admin.trashs.index')->with('message', "Xóa hết sách thành công");
    }
    public function delAllAuthor()
    {
        $authors = Author::onlyTrashed()->get();
        foreach($authors as $key => $author){
            $author->books()->forceDelete();
            $author->forceDelete();
        }
        return redirect()->route('admin.trashs.index')->with('message', "Xóa hết tác giả thành công");
    }
}
