@extends('index')

@section('pagetitle')
    Details
@endsection

@section('content')

    {!! HTML::ul($errors->all()) !!}

    {!! Form::model($user) !!}
    
    <div class="form-group">
        {!! Form::label('firstname', 'Firstname') !!}
        {!! Form::text('firstname', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lastname', 'Lastname') !!}
        {!! Form::text('lastname', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>
    
    {!! Form::close() !!}

    <h2>Books were taken</h2>

    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>Year</td>
            <td>Genre</td>
            <td>Took date</td>
            <td>Action</td>
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
                <td>

                    {!! Form::open(['url' => 'register/'.$book->pivot->id, 'class' => 'pull-right']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Return book', ['class' => 'btn btn-warning']) !!}
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