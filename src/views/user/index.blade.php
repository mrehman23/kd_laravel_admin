@extends('kd::layouts.app')
@section('content')
<?php
$users=(!empty($data['users']) ? $data['users'] : []);
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
            <h3 class="box-title">User List</h3>
            <div class="box-tools pull-right"></div>
        </div>

        <div class="box-body" style="display: block;">
            <table class="table">
                <thead>
                    <tr>
                        <td>S#</td>
                        <td>User Id</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Created</td>
                        <td>Last Updated</td>
                        <td>Action</td>
                    </tr>
                </thead>
                </tbody>
                        <?php $i=1; ?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><a target="_blank" href="{{ route('kd.user.view',$user->id) }}">{{ $user->id }}</a></td>
                                <td><a target="_blank" href="{{ route('kd.user.view',$user->id) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td></td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
