@extends('layouts.app')

@section('content')
    <h1>Edit Country</h1>

    <form method="POST" action="{{ route('countries.update', $country) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Country Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $country->name) }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="population" class="form-label">Population</label>
            <input type="number" name="population" id="population"
                class="form-control @error('population') is-invalid @enderror"
                value="{{ old('population', $country->population) }}" min="1" required>
            @error('population')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('countries.show', $country) }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection