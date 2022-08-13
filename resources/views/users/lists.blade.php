@extends('layouts.master')

@section('title', 'Danh sách người dùng')

@section('content')

    @include('users.includes.title')

    @include('users.includes.message')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xoá</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection
