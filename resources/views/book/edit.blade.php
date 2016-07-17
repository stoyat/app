@extends('layouts.app')

@section('pagetitle')
    Change info
@endsection

@section('content')

    {!! HTML::ul($errors->all()) !!}

    {!! Form::model($book, ['route' => ['books.update', $book->id], 'method' => 'PUT']) !!}
    
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('author', 'Author') !!}
        {!! Form::text('author', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('year', 'Year') !!}
        {!! Form::number('year', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('genre', 'Genre') !!}
        {!! Form::text('genre', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}
@endsection