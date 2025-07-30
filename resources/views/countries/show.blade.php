@extends('layouts.app')

@section('content')
    <h1>Country Details</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><strong>Name:</strong> {{ $country->name }}</p>
    <p><strong>Population:</strong> {{ $country->population }}</p>

    <a href="{{ route('countries.edit', $country) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back to List</a>
@endsection