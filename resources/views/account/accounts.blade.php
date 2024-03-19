@extends('layout')
@section('content')
    <div class="container">
        @if (Session::has('facebook_pages'))
    <ul>
        @foreach ($pages as $page)
            <li>
                <input type="checkbox" name="pages[]" value="{{ $page['id'] }}">
                {{ $page['name'] }}
            </li>
        @endforeach
    </ul>
    {{-- <form method="POST" action="{{ route('facebook.connect.pages') }}">
        @csrf
        <button type="submit">Connect Selected Pages</button>
    </form> --}}
@endif
    </div>
@endsection
