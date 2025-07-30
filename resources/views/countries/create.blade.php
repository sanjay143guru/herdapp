@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Add New Country</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('countries.store') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Country Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="population">Population</label>
                <input type="number" name="population" class="form-control" value="{{ old('population') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Create Country</button>
            <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection