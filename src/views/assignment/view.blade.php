@extends('layouts.app')
@section('content')
<?php
$opts = ['items' => $model->getItems()];
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none;"></i>';
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@include('kd::item._script',[$opts])
<div class="assignment-index">
    <h1>{{$model->user->name}}</h1>

    <div class="row">
        <div class="col-sm-5">
            <input class="form-control search" data-target="available"
                   placeholder="{{ __('Search for available') }}">
            <select multiple size="20" class="form-control list" data-target="available">
            </select>
        </div>
        <div class="col-sm-1">
            <br><br>
            <a class="btn btn-success btn-assign" href="{{ route('kd.assignment.assign',$model->id) }}" title="Assign" data-target="available">&gt;&gt; {!! $animateIcon !!}</a>
            <br><br>
            <a class="btn btn-danger btn-assign" href="{{ route('kd.assignment.revoke',$model->id) }}" title="Remove" data-target="assigned">&lt;&lt; {!! $animateIcon   !!}</a>
        </div>
        <div class="col-sm-5">
            <input class="form-control search" data-target="assigned"
                   placeholder="{{ __('Search for assigned') }}">
            <select multiple size="20" class="form-control list" data-target="assigned">
            </select>
        </div>
    </div>
</div>
@endsection
