@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h1>Countries List</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('countries.create') }}" class="btn btn-primary mb-3">
            Add New Country
        </a>

        @if($countries->count())
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Population</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $country)
                        <tr>
                            <td>{{ $country->name }}</td>
                            <td>{{ number_format($country->population) }}</td>
                            <td>
                                <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="{{ route('countries.show', $country->id) }}" class="btn btn-sm btn-info">
                                    View
                                </a>

                                <form action="{{ route('countries.destroy', $country->id) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('Delete this country?');">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $countries->links('pagination::bootstrap-4') }}
        @else
            <p>No countries found.</p>
        @endif

    </div>
@endsection