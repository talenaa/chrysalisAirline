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
        if ($request->places < 0 || $request->places > 200)
            return (response("Incorrect parameters", 400));
        $plane = Airplane::create(
            [
                "name" => $request->name,
                "places" => $request->places
            ]
        );
        
        return (response()->json($plane, 200));
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
