<?php
$opts = ['items' => $model->getItems()];
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none;"></i>';
?>
<link href="/prac/yii2-app/backend/web/assets/341045bb/css/bootstrap.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@include('kd::item._script',[$opts])
<div class="auth-item-view">
    <h1>{{$data['name']}}</h1>
    <p>
        @if(Route::has('kd.permission.update'))
            <a class="btn btn-primary" href="{{ route('kd.permission.edit',$data['name']) }}">Update</a>
        @endif
        @if(Route::has('kd.permission.delete'))
            <a class="btn btn-danger" href="{{ route('kd.permission.delete',$data['name']) }}" data-confirm="Are you sure you want to delete this item?" data-method="post">Delete</a>
        @endif
        @if(Route::has('kd.permission.create'))
            <a class="btn btn-success" href="{{ route('kd.permission.create') }}">Create</a>
        @endif
    </p>
    <div class="row">
        <div class="col-sm-11">
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr><th>Name</th><td>{{ $data['name'] }}</td></tr>
                    <tr><th>Description</th><td>{{ $data['description'] }}</td></tr>
                    <tr><th>Rule Name</th><td>{{ $data['rule_name'] }}</td></tr>
                    <tr><th>Data</th><td>{{ $data['data'] }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <input class="form-control search" data-target="available" placeholder="{{ __('Search for available') }}">
            <select multiple size="20" class="form-control list" data-target="available"></select>
        </div>
        <div class="col-sm-1">
            <br><br>
            <a class="btn btn-success btn-assign" href="{{ route('kd.permission.assign',$data['name']) }}" title="Assign" data-target="available">&gt;&gt; {!! $animateIcon !!}</a>
            <br><br>
            <a class="btn btn-danger btn-assign" href="{{ route('kd.permission.remove',$data['name']) }}" title="Remove" data-target="assigned">&lt;&lt; {!! $animateIcon   !!}</a>
        </div>
        <div class="col-sm-5">
            <input class="form-control search" data-target="assigned" placeholder="{{ __('Search for assigned') }}">
            <select multiple size="20" class="form-control list" data-target="assigned"></select>
        </div>
    </div>
</div>
