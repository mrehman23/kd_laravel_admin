<?php
$lists=(!empty($data['list']) ? $data['list'] : []);
?>
<div class="role-index">
    <h1><?= 'Permissions' ?></h1>
    <p>
        @if(Route::has('kd.permission.create'))
            <a class="btn btn-success" href="{{ route('kd.permission.create') }}">Create Permission</a>
        @endif
    </p>
    <table class="table">
        <thead>
            <tr>
                <td>S#</td>
                <td>Name</td>
                <td>Description</td>
                <td>Last Updated</td>
                <td>Action</td>
            </tr>
        </thead>
        </tbody>
                <?php $i=1; ?>
                @foreach($lists as $list)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $list['name'] }}</td>
                        <td>{{ $list['description'] }}</td>
                        <td>{{ $list['updated_at'] }}</td>
                        <td>
                            <a href="{{ route('kd.permission.view',$list['name']) }}" title="View"><span class="glyphicon glyphicon-eye-open">View</span></a> 
                            <a href="{{ route('kd.permission.edit',$list['name']) }}" title="Update"><span class="glyphicon glyphicon-pencil">Update</span></a>
                            <a href="{{ route('kd.permission.delete',$list['name']) }}" title="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash">Delete</span></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
        </table>
</div>
