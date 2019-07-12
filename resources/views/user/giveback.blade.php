@extends('user.masteruser')
@section('content')



<h3>Trả sách</h3>


<hr>

<p>Thời gian mượn : {{ $book->name }}</p>
<p>Thời gian hẹn trả: {{ $book->author->name }}</p>
<p>Tên sách : {{ $book->status }}</p>


<div>
    <a class="btn btn-primary" onclick="document.getElementById('backbook-{{ $book->id }}').submit()">Trả sách</a>
    <form action="{{ route('user.giveback.edit', ['id' => $book->id]) }}" method="post" id="backbook-{{ $book->id }}">
        {{ csrf_field() }}
        {{ method_field('put') }}
    </form>
</div>







@endsection
