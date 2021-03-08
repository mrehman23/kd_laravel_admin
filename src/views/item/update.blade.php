@extends('kd::layouts.app')
@section('content')
<div class="auth-item-update">
    <h1>{{ __('Update Permission : '.$model['name']) }}</h1>
	@include('kd::item._form',['model' => $model,'ftype'=>'update'])
</div>
@endsection
