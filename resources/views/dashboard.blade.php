@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Feeds</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Feed Name</th>
                                <th>Start Date</th>
                                <th>Last Updated</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feeds as $feed)
                                <tr>
                                    <td>{{ $feed->title }}</td>
                                    <td>{{ date('m-d-Y @ H:m', strtotime($feed->created_at)) }}</td>
                                    <td>{{ date('m-d-Y @ H:m', strtotime($feed->updated_at)) }}</td>
                                    <td align="right">
                                        <a href="#" class="btn btn-xs btn-primary">Default</a>
                                        <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
