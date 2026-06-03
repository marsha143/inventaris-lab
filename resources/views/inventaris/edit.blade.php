@extends('layouts.app')
@section('title', 'Edit Inventaris')
@section('content')
    <h1>Edit Inventaris Laboratorium</h1>
    <form method="POST" action="{{ route('inventaris.update', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('inventaris._form')
    </form>
@endsection
