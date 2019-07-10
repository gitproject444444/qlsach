@extends('admin.masteradmin')
@section('content')

<div class="row">
    <div class="col-md-3">
        <!-- Nút Tao Tác giả -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tao Tác
            giả</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                        <h4 class="modal-title">Tạo mới tác gỉa</h4>
                    </div>
                    <div class="modal-body">
                        <form id="qlForm" action="{{ route('admin.authors.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Tên tác gỉa</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên tác gỉa"
                                    value="{{ old('name') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            {{-- <button type="submit" class="btn btn-success">Tao Tác giả</button> --}}
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
    <div class="col-md-3 offset-md-4">
        <div class="alert alert-success edit hidden"></div>
        <div class="alert alert-danger del hidden"></div>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên giả</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($authors ?: [] as $author)
        <tr>
            <td>{{ $author->id }}</td>
            <td class="name">{{ $author->name }}</td>
            <td>
                <a data-id="{{ $author->id }}" class="btn btn-primary click">Sửa</a>
                <a href="" class="btn btn-danger" onclick="event.preventDefault();
                            window.confirm('Bạn đã chắc chắn xóa chưa?') ?
                           document.getElementById('authors-delete-{{ $author->id }}').submit() :
                           0;">Xóa tác gia</a>
                <form action="{{ route('admin.authors.destroy', ['id' => $author->id]) }}" method="post"
                    id="authors-delete-{{ $author->id }}">
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
{{ $authors->links() }}




@endsection

@section('body_scripts_bottom')
<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/editauthor.js') }}"></script>


@endsection
