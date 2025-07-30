@extends('layouts.app')

@section('content')
    <h1>Country List</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Population</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->name }}</td>
                    <td>{{ number_format($country->population) }}</td>
                    <td>
                        <a href="{{ route('countries.edit', $country->id) }}">Edit</a>
                        <form method="POST" action="{{ route('countries.destroy', $country->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $countries->links() }}
@endsection