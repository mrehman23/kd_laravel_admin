@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('kd.user.update') }}">
    @csrf
    <input type="hidden" name="id" value="{{$model->id}}" />
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $model->name }}" required autocomplete="name" autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ $model->email }}" required autocomplete="email">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" value="123456" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="123456" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

        <div class="col-md-6">
            <select name="status">
                <option value="1" {{ $model->status==1 ? "selected" : "" }}>Active</option>
                <option value="0" {{ $model->status==0 ? "selected" : "" }}>Inactive</option>
            </select>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
    </div>
</form>
@endsection
