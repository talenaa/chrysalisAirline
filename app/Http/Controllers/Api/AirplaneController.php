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
        if ($request->seats < 0 || $request->seats > 200)
        return (response("Please, insert the correct range of seats (10 to 200)", 400));
    
        $plane = Airplane::create([
            'name' => $request->name,
            'seats' => $request->seats
        ]);
        
        return response()->json($plane, 201);
    }

    public function update(Request $request, string $id)
    {
        $plane = Airplane::find($id);
        $plane->update(
            [
                "name" => $request->name,
                "seats" => $request->seats
            ]
        );

        return (response()->json($plane, 200));
    }

    public function destroy(string $id)
    {
        Airplane::find($id)->delete();
    }
}