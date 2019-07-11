@extends('admin.masteradmin')
@section('content')
  <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên thành viên</th>
            <th scope="col">Email</th>
            <th scope="col">Sách đang mượn</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users ?: [] as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td class="name">{{ $user->name }}</td>
            <td class="email">
                {{ $user->email }}
            </td>
            <td>

            </td>

            <td>
                <a data-id="{{ $user->id }}" class="btn btn-primary click">Sửa</a>
                <a href="" class="btn btn-danger" onclick="event.preventDefault();
                    window.confirm('Bạn đã chắc chắn xóa chưa?') ?
                   document.getElementById('users-delete-{{ $user->id }}').submit() :
                   0;">Xóa Sách</a>
                <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="post"
                    id="users-delete-{{ $user->id }}">
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
{{ $users->links() }}

@endsection
