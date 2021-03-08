@extends('kd::layouts.app')
@section('content')
<form method="POST" action="{{ route('kd.user.store') }}">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password') }}" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

        <div class="col-md-6">
            <select name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </div>
</form>
@endsection
