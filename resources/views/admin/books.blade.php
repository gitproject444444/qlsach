@extends('admin.masteradmin')
@section('content')

<div class="row">
    <div class="col-md-3">
        <!-- Nút tạo sách -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tạo sách</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
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
                                <label for="author">Tên tác giả</label>
                                <input type="text" class="form-control" id="author" name="author" placeholder="Tên tác giả"
                                    value="{{ old('author') }}">
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
    </div>
    {{-- End Modal --}}

    {{-- tabBook--}}
    <div class="col-md-7 offset-md-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="allbook-tab" data-toggle="tab" href="#allbook" role="tab"
                    aria-controls="allbook" aria-selected="true">Tất cả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="borrow-tab" data-toggle="tab" href="#borrow" role="tab" aria-controls="borrow"
                    aria-selected="false">Đang muợn</a>
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
    {{--End tabBook--}}
</div>


<div class="tab-content" id="myTabContent">
    {{--All book--}}
    <div class="tab-pane fade show active" id="allbook" role="tabpanel" aria-labelledby="allbook-tab">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Sach</th>
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
                    <td>
                        <div contentEditable='true' class='edit' id='name_{{ $book->id }}'>
                            {{ $book->name }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ $book->author->name }}
                        </div>
                    </td>
                    <td>{{ $book->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.books.edit', ['id' => $book->id]) }}"
                            class="btn btn-primary btn-sm"></a>

                        <a href="{{ route('admin.books.destroy', ['id' => $book->id]) }}"
                            class="btn btn-outline-dark btn-sm"></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- End All book--}}
    <div class="tab-pane fade" id="borrow" role="tabpanel" aria-labelledby="borrow-tab">...</div>
    <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">...</div>
    <div class="tab-pane fade" id="busy" role="tabpanel" aria-labelledby="busy-tab">...</div>
</div>
    @endsection
    @section('scripts')
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    @endsection
