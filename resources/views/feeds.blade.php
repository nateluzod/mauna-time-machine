@extends('layouts.feeds')

@section('content')
    <ul>
        @foreach ($feeds as $feed)
            <li>
                <a href="/feed/{{ $feed->slug }}">
                    {{ $feed->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
