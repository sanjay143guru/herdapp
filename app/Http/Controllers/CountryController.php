<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('population', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(5);

        return view('countries.index', compact('countries'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $countries = Country::where('name', 'like', '%' . $query . '%')
            ->orWhere('population', 'like', '%' . $query . '%')
            ->orderBy('population', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(5);

        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:countries,name',
            'population' => 'required|integer|min:1',
        ]);

        $country = Country::create([
            'name' => $request->name,
            'population' => $request->population,
        ]);

        return redirect()->route('countries.show', ['country' => $country->id])
            ->with('success', 'Country added successfully!');
    }

    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:countries,name,' . $country->id,
            'population' => 'required|integer|min:1',
        ]);

        $country->update([
            'name' => $request->name,
            'population' => $request->population,
        ]);

        return redirect()->route('countries.index')
            ->with('success', 'Country updated successfully!');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')
            ->with('success', 'Country deleted successfully!');
    }
}
