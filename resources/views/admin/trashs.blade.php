@extends('admin.masteradmin')
@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="book-tab" data-toggle="tab" href="#book" role="tab" aria-controls="book"
            aria-selected="true">Sách</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="author-tab" data-toggle="tab" href="#author" role="tab" aria-controls="author"
            aria-selected="false">Tác giả</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade in active" id="book" role="tabpanel" aria-labelledby="book-tab">
        <a class="btn btn-danger btn-sm" onclick="event.preventDefault();
            window.confirm('Bạn đã chắc chắn xóa chưa?') ?
           document.getElementById('booksall-delete').submit() :
           0;">Xóa toàn bộ sách</a>
        <form action="{{ route('admin.trashs.delallbook') }}" method="post"
            id="booksall-delete">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên Sách</th>
                    <th scope="col">Tác Giả</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books ?: [] as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->author->name }}</td>

                    <td>
                        <form action="{{ route('admin.trashs.restorebook', ['id' => $book->id]) }}" method="post"
                            id="books-restorebook-{{ $book->id }}">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                        </form>
                        <a class="btn btn-primary btn-sm"
                            onclick="event.preventDefault(); document.getElementById('books-restorebook-{{ $book->id }}').submit()">Khôi
                            phục</a>
                        <a class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                window.confirm('Bạn đã chắc chắn xóa hẳn chưa?') ?
                               document.getElementById('books-delete-{{ $book->id }}').submit() :
                               0;">Xóa sách</a>
                        <form action="{{ route('admin.trashs.delcompletelybook', ['id' => $book->id]) }}" method="post"
                            id="books-delete-{{ $book->id }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5">No data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $books->links() }}
    </div>

    <div class="tab-pane fade" id="author" role="tabpanel" aria-labelledby="author-tab">
        <a class="btn btn-danger btn-sm" onclick="event.preventDefault();
            window.confirm('Bạn đã chắc chắn xóa hết tác giả chưa?') ?
           document.getElementById('authorsall-delete').submit() :
           0;">Xóa toàn bộ tác giả</a>
        <form action="{{ route('admin.trashs.delallauthor') }}" method="post"
            id="authorsall-delete">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tác tác giả</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors ?: [] as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->name }}</td>
                    <td>
                        <form action="{{ route('admin.trashs.restoreauthor', ['id' => $author->id]) }}" method="post"
                            id="authors-restoreauthor-{{ $author->id }}">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                        </form>
                        <a class="btn btn-primary btn-sm"
                            onclick="event.preventDefault(); document.getElementById('authors-restoreauthor-{{ $author->id }}').submit()">Khôi
                            phục</a>
                        <a class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                window.confirm('Bạn đã chắc chắn xóa chưa?') ?
                               document.getElementById('authors-delete-{{ $author->id }}').submit() :
                               0;">Xóa hẳn</a>
                        <form action="{{ route('admin.trashs.delcompletelyauthor', ['id' => $author->id]) }}"
                            method="post" id="authors-delete-{{ $author->id }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No data</td>
                </tr>
                @endforelse
            </tbody>
            {{-- {{ $authors->links() }} --}}
        </table>
    </div>
</div>
@endsection
