

@extends('layouts.feeds')

@section('content')
    <h1>{{ $feed->title }}</h1>
    @foreach ($feed->frames as $frame)
        <img class="frame" 
            alt="{{ $feed->title }} at {{ $frame->created_at }}"
            src="{{ Storage::disk('s3')->url("{$feed->slug}/{$frame->filename}.jpg") }}">
    @endforeach
@endsection
