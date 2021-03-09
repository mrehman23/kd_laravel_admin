@extends('layouts.app')
@section('content')
<?php
$lists=(!empty($data['list']) ? $data['list'] : []);
// dd($lists);
?>
<div class="assignment-index">
    <h1><?= 'Assignments' ?></h1>
    <p>
        @if(Route::has('kd.assignment.create'))
            <a class="btn btn-success" href="{{ route('kd.assignment.create') }}">Create Permission</a>
        @endif
    </p>
    <table class="table">
        <thead>
            <tr>
                <td>S#</td>
                <td>User</td>
                <td>Action</td>
            </tr>
        </thead>
        </tbody>
                <?php $i=1; ?>
                @foreach($lists as $list)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $list->name }}</td>
                        <td>
                            <a href="{{ route('kd.assignment.view',$list['id']) }}" title="View"><span class="glyphicon glyphicon-eye-open">View</span></a> 
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
        </table>
</div>
@endsection
