@extends('layout')
@section('content')
    <div class="container">
        @if (Auth::check())
    @if (Auth::user()->facebookPages->count() > 0)
        <h2>Your Connected Facebook Pages:</h2>
        <ul>
            @foreach (Auth::user()->facebookPages as $page)
                <li>
                    <img src="https://graph.facebook.com/{{ $page->page_id }}/picture?type=small&height=50&width=50" alt="{{ $page->name }} Logo">
                    {{ $page->name }} ({{ $page->page_id }})
                    <form action="{{ route('facebook.store', $page->id) }}" method="POST">
                        @csrf
                        <button type="submit">Add Page</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>You haven't connected any Facebook Pages yet.</p>
        <a href="{{ route('facebook.auth') }}">Connect Facebook Page</a>
    @endif
@endif
    </div>
@endsection
