@extends('index')

@section('pagetitle')
    Create account
@endsection

@section('content')

    {!! HTML::ul($errors->all()) !!}

    {!! Form::open(['url'=> 'users']) !!}
    
    <div class="form-group">
        {!! Form::label('firstname', 'Name') !!}
        {!! Form::text('firstname', Input::old('firstname'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lastname', 'Surname') !!}
        {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', Input::old('email'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}
@endsection