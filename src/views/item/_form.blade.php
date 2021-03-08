@php 
$is_edit=($ftype=="update" ? true  : false);
@endphp
<div class="auth-item-form">
    <form method="POST" action="{{ ($is_edit ? route('kd.permission.update') : route('kd.permission.store')) }}">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="name" class="form-control" name="name" value="{{ ($is_edit ? $model['name'] : '') }}" maxlength="64">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    <div class="col-md-6">
                        <textarea id="description" class="form-control" name="description" rows="2">{{ ($is_edit ? $model['description'] : '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! ($is_edit ? '<button type="submit" class="btn btn-primary">Update</button>' : '<button type="submit" class="btn btn-success">Create</button>') !!}
        </div>
    </form>
</div>
