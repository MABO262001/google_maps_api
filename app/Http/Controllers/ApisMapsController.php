<?php

namespace App\Http\Controllers;

use App\Models\googlemaps;
use Illuminate\Http\Request;

class ApisMapsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maps = googlemaps::all();
        return view('VistaApisGoogleMaps.index', compact('maps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $api = config('services.google_maps.api_key');
        return view ('VistaApisGoogleMaps.create', compact('api'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'latitud'=> 'required|numeric',
            'longitud'=> 'required|numeric',
        ]);

        $maps = new googlemaps();
        $maps ->latitud = $validated['latitud'];
        $maps ->longitud = $validated['longitud'];
        // dd($maps);
        $maps ->save();

        return redirect()->route('api.index')->with('success', 'Punto creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $api = config('services.google_maps.api_key');
        $maps = googlemaps::find($id);
        return view ('VistaApisGoogleMaps.edit', compact('api', 'maps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'latitud'=> 'required|numeric',
            'longitud'=> 'required|numeric',
        ]);

        $maps = googlemaps::find($id);
        $maps ->latitud = $validated['latitud'];
        $maps ->longitud = $validated['longitud'];
        $maps ->save();

        return redirect()->route('api.index')->with('success', 'Punto creado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $maps = googlemaps::find($id);
        $maps->delete();

        return redirect()->route('api.index')->with('success', 'Punto eliminado con éxito');
    }
}
