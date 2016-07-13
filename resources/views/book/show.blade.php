@extends('index')

@section('pagetitle')
    Details, {{ $book->title }}
@endsection

@section('content')

    {!! HTML::ul($errors->all()) !!}

    {!! Form::model($book) !!}
    
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('author', 'Author') !!}
        {!! Form::text('author', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('year', 'Year') !!}
        {!! Form::number('year', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('genre', 'Genre') !!}
        {!! Form::text('genre', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>
    
    {!! Form::close() !!}

    <h2>Book holders</h2>

    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <td>Name</td>
            <td>Surname</td>
            <td>Email</td>
            <td>Took date</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->pivot->created_at }}</td>
                <td>

                    {!! Form::open(['url' => 'register/'.$user->pivot->id, 'class' => 'pull-right']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Return book', ['class' => 'btn btn-warning']) !!}
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