<?php

namespace App\Http\Controllers\Api;

use App\Models\Airplane;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AirplaneController extends Controller
{
    public function index()
    {
        return (response()->json(Airplane::All(), 200));
    }

    public function show(string $id)
    {
        return response()->json(Airplane::find($id), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'places' => 'required|integer|min:0|max:200'
        ]);
    
        $plane = Airplane::create([
            'name' => $request->name,
            'places' =>$request->places
        ]);
        
        return response()->json($plane, 201);
    }

    public function update(Request $request, string $id)
    {
        $plane = Airplane::find($id);
        $plane->update(
            [
                "name" => $request->name,
                "places" => $request->places
            ]
        );

        return (response()->json($plane, 200));
    }

    public function destroy(string $id)
    {
        Airplane::find($id)->delete();
    }
}
