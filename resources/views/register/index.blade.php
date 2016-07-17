@extends('layouts.app')

@section('pagetitle')
    Register
@stop

@section('content')
    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <td>Id</td>
            <td>User</td>
            <td style="max-width: 40%">Book</td>
            <td width="170">Took date</td>
            <td width="130">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->user->firstname }} {{ $record->user->lastname }}</td>
                <td>{{ $record->book->title }},<br>{{ $record->book->author }}, {{ $record->book->year }} ({{ $record->book->genre }})</td>
                <td>{{ $record->created_at }}</td>
                <td>

                    {!! Form::open(['url' => 'register/'.$record->id, 'class' => 'pull-right']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Return book', ['class' => 'btn btn-warning']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="right">
        {{ $records->render() }}
    </div>

@endsection