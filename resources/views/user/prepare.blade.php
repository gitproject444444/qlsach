@extends('user.masteruser')
@section('content')
<h3>Mượn sách</h3>

<p>Tên sách: {{ $book->name}}</p>
<p>Tác giả: {{ $book->author->name}}</p>
<form action="{{ route('user.borrow.store') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" value="{{ $book->id }}" name="id"/>
        <input type="text" value="{{Carbon\Carbon::now()->format('d-m-Y')}}" />

    <div class="widthinput form-group {{ $errors->has('date') ? 'has-error' : '' }}">
            <input type="date" value="{{ old('date') }}" class="form-control" id="name" name="date">
            <span class="help-block">{{ $errors->first('date') }}</span>
    </div>
     <button type="submit" class="btn btn-success">Mượn sách</button>
</form>
@endsection
