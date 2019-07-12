@extends('user.masteruser')
@section('content')
<h3>Xem sách</h3>

<p>Mượn sách > {{ $book->name }}</p>
<hr>

<p>Tên sách sách : {{ $book->name }}</p>
<p>Tác giả : {{ $book->author->name }}</p>
<p>Trạng thái : {{ $book->status }}</p>





<div>
    <a href="{{ route('user.prepareborrow', ['id' => $book->id]) }}" class="btn btn-primary click">Mượn sách</a>
</div>


@endsection
