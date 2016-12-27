

@extends('layouts.feeds')

@section('content')
    @foreach ($feed->frames as $frame)
        <img alt="{{ $feed->title }} at {{ $frame->created_at }}" 
            src="{{ Storage::disk('s3')->url("{$feed->slug}/{$frame->filename}.jpg") }}">
    @endforeach
@endsection
