<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleMapsController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacion::all();
        return view('VistaGoogleMaps.index', compact('ubicaciones'));
    }

    public function create()
    {
        $apiKey = config('services.google_maps.api_key');
        return view('VistaGoogleMaps.create', compact('apiKey'));
    }
    public function edit($id)
    {
        $apiKey = config('services.google_maps.api_key');
        $ubicacion = Ubicacion::find($id);
        return view('VistaGoogleMaps.edit', compact('apiKey', 'ubicacion'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        $ubicacion = new Ubicacion();
        $ubicacion->latitud = $validated['latitud'];
        $ubicacion->longitud = $validated['longitud'];
        $ubicacion->users_id = Auth::id();
        $ubicacion->save();

        return redirect()->route('mapa.index')->with('success', 'Punto creado con éxito');
    }

    public function destroy($id)
    {
        $ubicacion = Ubicacion::find($id);
        $ubicacion->delete();

        return redirect()->route('mapa.index')->with('success', 'Mapa eliminada con éxito');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        $ubicacion = Ubicacion::find($id);
        $ubicacion->latitud = $validated['latitud'];
        $ubicacion->longitud = $validated['longitud'];
        $ubicacion->save();

        return redirect()->route('mapa.index')->with('success', 'Punto actualizado con éxito');
    }
}
