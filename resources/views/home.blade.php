@extends('layouts.app')

@section('pagetitle')
    Books were taken
@endsection

@section('content')
    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>Year</td>
            <td>Genre</td>
            <td>Took date</td>
            @can('manageRegister')
                <td>Action</td>
            @endcan
        </tr>
        </thead>
        <tbody>

        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->year }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->pivot->created_at }}</td>
                @can('manageRegister')
                    <td>

                        {!! Form::open(['url' => 'bookregister/'.$book->pivot->id, 'class' => 'pull-right']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::submit('Return book', ['class' => 'btn btn-warning']) !!}
                        {!! Form::close() !!}

                    </td>
                @endcan
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="pull-right">
        {{ $books->render() }}
    </div>
@endsection