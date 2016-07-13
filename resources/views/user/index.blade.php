@extends('index')

@section('pagetitle')
    User list
@endsection

@section('content')
    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Surname</td>
            <td>Email</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td width="209">
                    <a class="btn btn-small btn-success" href="{{ URL::to('users/'.$user->id) }}">Details</a>
                    <a class="btn btn-small btn-success" href="{{ URL::to('users/'.$user->id.'/edit') }}">Edit</a>

                    {!! Form::open(['url' => 'users/'.$user->id, 'class' => 'pull-right']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-warning']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="right">
        {{ $users->render() }}
    </div>
@endsection