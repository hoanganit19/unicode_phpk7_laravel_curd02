@extends('layouts.master')

@section('title', 'Danh sách người dùng')

@section('content')

    @include('users.includes.title')

    @include('users.includes.message')

    <a href="{{route('users.add')}}" class="btn btn-primary">Thêm mới</a>

    <hr>

    <form action="">
        <div class="row">
            <div class="col-3">
                <select name="status" class="form-control">
                    <option value="all">Tất cả trạng thái</option>
                    <option value="active" {{request()->status=='active'?'selected':false}}>Kích hoạt</option>
                    <option value="inactive" {{request()->status=='inactive'?'selected':false}}>Chưa kích hoạt</option>
                </select>
            </div>

            <div class="col-3">
                <select name="group_id" class="form-control">
                    <option value="0">Tất cả nhóm</option>
                    @if ($groups)
                        @foreach($groups as $group)
                            <option value="{{$group->id}}" {{request()->group_id==$group->id?'selected':false}} >{{$group->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-4">
                <input type="search" name="keyword" class="form-control" placeholder="Từ khoá..." value="{{request()->keyword}}"/>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Nhóm</th>
                <th>Trạng thái</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xoá</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count()>0)
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            {{$user->group->name}}
                        </td>
                        <td>
                            {!!$user->status==1?'<button class="btn btn-success btn-sm">Kích hoạt</button>': '<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>'!!}
                        </td>
                        <td>
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                        <td>
                            <a href="#" onclick="handleDelete('delete_user', event)" class="btn btn-danger">Xoá</a>
                            @include('includes.delete', ['url' => route('users.delete', $user->id), 'formId' => 'delete_user'])
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{$users->links()}}
    </div>
@endsection
