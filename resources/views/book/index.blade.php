@extends('layouts.app')

@section('pagetitle')
    Book list
@stop

@section('content')
    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Author</td>
            <td>Year</td>
            <td>Genre</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>

            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->genre }}</td>
                    <td width="209">
                        <a class="btn btn-small btn-success" href="{{ URL::to('books/'.$book->id) }}">Details</a>
                        <a class="btn btn-small btn-success" href="{{ URL::to('books/'.$book->id.'/edit') }}">Edit</a>

                        {!! Form::open(['url' => 'books/'.$book->id, 'class' => 'pull-right']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-warning']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="right">
        {{ $books->render() }}
    </div>

@endsection