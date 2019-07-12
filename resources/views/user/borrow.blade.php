@extends('user.masteruser')
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên Sách</th>
            <th scope="col">Tác Giả</th>
            <th scope="col">Trạng thaí</th>
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
            <td>
                <a href="{{ route('user.prepareborrow', ['id' => $book->id]) }}" class="btn btn-primary click">Mượn sách</a>

                <a href="{{ route('user.watchbook', ['id' => $book->id]) }}" class="btn btn-primary click">Xem sách</a>

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
