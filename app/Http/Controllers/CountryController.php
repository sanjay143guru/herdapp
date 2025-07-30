<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // Show paginated countries sorted by population desc, then name asc
    public function index()
    {
        $countries = Country::orderBy('population', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('countries.index', compact('countries'));
    }

    // Search countries by name or population
    public function search(Request $request)
    {
        $query = $request->input('query');

        $countries = Country::where('name', 'like', '%' . $query . '%')
            ->orWhere('population', 'like', '%' . $query . '%')
            ->orderBy('population', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('countries.index', compact('countries'));
    }

    // Show form to create country
    public function create()
    {
        return view('countries.create');
    }

    // Store new country
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

        return redirect()->route('countries.show', $country->id)
            ->with('success', 'Country added successfully!');
    }

    // Show one country details
    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    // Show form to edit country
    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    // Update country info
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

    // Delete a country
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')
            ->with('success', 'Country deleted successfully!');
    }

    // Add Albania with population 2,771,508 (if not exists)
    public function addAlbania()
    {
        $exists = Country::where('name', 'Albania')->exists();
        if (!$exists) {
            Country::create([
                'name' => 'Albania',
                'population' => 2771508,
            ]);
        }

        return redirect()->route('countries.index')
            ->with('success', 'Albania added successfully!');
    }

    // Update the 3rd listed country's population rounded up to nearest million
    public function updateThirdCountryPopulation()
    {
        $country = Country::orderBy('population', 'desc')
            ->orderBy('name', 'asc')
            ->skip(2)
            ->first();

        if ($country) {
            $country->population = ceil($country->population / 1000000) * 1000000;
            $country->save();

            return redirect()->route('countries.index')
                ->with('success', "Updated {$country->name} population to " . number_format($country->population));
        }

        return redirect()->route('countries.index')
            ->with('error', 'No third country found.');
    }

    // Delete United Kingdom if exists
    public function deleteUnitedKingdom()
    {
        $deleted = Country::where('name', 'United Kingdom')->delete();

        $message = $deleted ? 'United Kingdom deleted.' : 'United Kingdom not found.';
        return redirect()->route('countries.index')->with('success', $message);
    }
}
