@extends('layouts.feeds')

@section('content')
    <ul class="feed">
        @foreach ($feeds as $feed)
            <li>
                <a href="/feed/{{ $feed->slug }}">
                    {{ $feed->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
