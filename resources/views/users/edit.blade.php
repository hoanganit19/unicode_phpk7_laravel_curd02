@extends('layouts.master')

@section('title', $title)

@section('content')
    @include('users.includes.title')

    @include('users.includes.message')

    @include('users.includes.form')

@endsection
