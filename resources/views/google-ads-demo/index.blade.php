
@extends('layouts.default')
@section('content')
<div class="container-fluid mt-2">
    <table class="table table-responsive table-border">
        <thead>
            <tr>
                <th>Campaign ID</th>
                <th>Campaign Name</th>
                <th>AdGroup ID</th>
                <th>AdGroup Name</th>
                <th>Impressions</th>
                <th>Clicks</th>
                <th>Abs Top Imp</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adgroupArr as $value)
            <tr>
                <td>{{ $value['campaign_id'] }}</td>
                <td>{{ $value['campaign_name'] }}</td>
                <td>{{ $value['adgroup_id'] }}</td>
                <td>{{ $value['adgroup_name'] }}</td>
                <td>{{ $value['impressions'] }}</td>
                <td>{{ $value['clicks'] }}</td>
                <td>{{ $value['abstopimp'] }}</td>
                <td>{{ $value['cost_micros'] }}</td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@stop

