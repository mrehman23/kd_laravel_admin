<div class="user-view">
    <h1>{{ $model->name }}</h1>
    <p>
        @if(Route::has('kd.user.update'))
            <a class="btn btn-primary" href="{{ route('kd.user.edit',$model->id) }}">Update</a>
        @endif
        @if(Route::has('kd.user.activate'))
            <a class="btn btn-primary" href="{{ route('kd.user.activate',$model->id) }}">{{(($model->status==1) ? 'Deactivate' : 'Activate')}}</a>
        @endif
        @if(Route::has('kd.user.delete'))
            <a class="btn btn-danger" href="{{ route('kd.user.delete',$model->id) }}" data-confirm="Are you sure you want to delete this item?" data-method="post">Delete</a>
        @endif
    </p>
    <table class="table table-striped table-bordered">
        <tbody>
            <tr><th>Name</th><td>{{ $model->name }}</td></tr>
            <tr><th>Email</th><td><a href="mailto:{{ $model->email }}">{{ $model->email }}</a></td></tr>
            <tr><th>Created At</th><td>{{ $model->created_at }}</td></tr>
            <tr><th>Status</th><td>{{ $model->status == 0 ? 'Inactive' : 'Active' }}</td></tr>
        </tbody>
    </table>
</div>