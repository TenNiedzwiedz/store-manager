@extends('layouts/main')

@section('content')
    <h1>Store Manager</h1>

    <form action="{{ route('logout') }}" method="POST" id="logout-form">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection