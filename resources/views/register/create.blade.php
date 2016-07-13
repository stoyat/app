@extends('index')

@section('pagetitle')
    Add book
@endsection

@section('content')

    {!! HTML::ul($errors->all()) !!}

    {!! Form::open(['url'=> 'register']) !!}

    <div class="form-group">
        {!! Form::label('book_id', 'Book') !!}
        {{ Form::select('book_id', $books, Form::old('book_id')) }}
    </div>

    <div class="form-group">
        {!! Form::label('user_id', 'User') !!}
        {{ Form::select('user_id', $users, Form::old('user_id')) }}
    </div>

    <div class="form-group">
        {!! Form::submit('Assign', ['class' => 'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}
@endsection