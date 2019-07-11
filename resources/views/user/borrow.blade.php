@extends('user.masteruser')
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên Sách</th>
            <th scope="col">Tác Giả</th>
            <th scope="col">Trạng thaí</th>
            <th scope="col">Người mượn</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books ?: [] as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td class="name">{{ $book->name }}</td>
            <td class="author">
                {{ $book->author->name }}
            </td>
            <td>
                {{ $book->status == 0 ? 'Chưa mượn' : "Đã mượn" }}
            </td>
            <td>{{ $book->created_at }}</td>
            <td>
                <a data-id="{{ $book->id }}" class="btn btn-primary click">Xem sách</a>
                <a href="" class="btn btn-danger" onclick="event.preventDefault();
                    window.confirm('Bạn đã chắc chắn xóa chưa?') ?
                   document.getElementById('books-delete-{{ $book->id }}').submit() :
                   0;">Mượn sách</a>
                <form action="{{ route('admin.books.destroy', ['id' => $book->id]) }}" method="post"
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
@endsection
