@extends('admin.masteradmin')
@section('content')

<div class="row">
    <div class="col-md-3 parent">
        <!-- Nút tạo sách -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tạo sách</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                        <h4 class="modal-title">Tạo mới sách</h4>
                    </div>
                    <div class="modal-body">
                        <form id="qlForm" action="{{ route('admin.books.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Tên sách</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên sách"
                                    value="{{ old('name') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                                <label for="author">Tác giả</label>
                                <select name="author" id="author" class="form-control">
                                    <option value="">Điền tên tác giả</option>
                                    @if (count($authors) > 0)
                                    @foreach($authors as $author)
                                    <option value="{{ $author->name }}"
                                        {{ old('author') == $author->id ? 'selected' : '' }}>{{ $author->name }}
                                    </option>
                                    @endforeach
                                    @endif

                                </select>
                                <span class="help-block">{{ $errors->first('author') }}</span>
                            </div>
                            {{-- <button type="submit" class="btn btn-success">Tạo sách</button> --}}
                        </form>
                    </div>
                    <div class="modal-footer">

                        <a href="" class="btn btn-primary"
                            onclick="event.preventDefault();document.getElementById('qlForm').submit()">Tạo</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="parrentalert">
            <div class="alert alert-success edit hidden"></div>
            <div class="alert alert-danger del hidden"></div>
        </div> --}}
    </div>
    {{-- End Modal --}}

    {{-- tabBook--}}
    <div class="col-md-9">
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="allbook-tab" data-toggle="tab" href="#allbook" role="tab"
                        aria-controls="allbook" aria-selected="true">Tất cả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="borrow-tab" data-toggle="tab" href="#borrow" role="tab"
                        aria-controls="borrow" aria-selected="false">Đang muợn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="free-tab" data-toggle="tab" href="#free" role="tab" aria-controls="free"
                        aria-selected="false">Chưa mượn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="busy-tab" data-toggle="tab" href="#busy" role="tab" aria-controls="busy"
                        aria-selected="false">Đang xem</a>
                </li>

            </ul>

        </div>
    </div>
    {{--End tabBook--}}
</div>
<div class="tab-content" id="myTabContent">
    {{--All book--}}
    <div class="tab-pane fade in active" id="allbook" role="tabpanel" aria-labelledby="allbook-tab">
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
                        <span>{{ $book->author->name }}</span>
                        <select name="editauthor" id="editauthor{{ $book->id  }}" class="hidden" class="form-control">
                            @if (count($authors) > 0)
                            @foreach($authors as $author)
                            <option value="{{ $author->name }}"
                                {{$book->author->name == $author->name ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </td>
                    <td>
                        {{ $book->status == 0 ? 'Chưa mượn' : "Đã mượn" }}
                    </td>
                    <td>{{ $book->created_at }}</td>
                    <td>
                        <a data-id="{{ $book->id }}" class="btn btn-primary click">Sửa</a>
                        <a href="" class="btn btn-danger" onclick="event.preventDefault();
                            window.confirm('Bạn đã chắc chắn xóa chưa?') ?
                           document.getElementById('books-delete-{{ $book->id }}').submit() :
                           0;">Xóa Sách</a>
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
        {{ $books->links() }}
    </div>
    {{-- End All book--}}
    <div class="tab-pane fade" id="borrow" role="tabpanel" aria-labelledby="borrow-tab">...</div>
    <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">...</div>
    <div class="tab-pane fade" id="busy" role="tabpanel" aria-labelledby="busy-tab">...</div>
</div>

@endsection

@section('body_scripts_bottom')
<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/editbook.js') }}"></script>


@endsection
