<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    public function index()
    {
        return (response()->json(Flight::All(), 200));
    }

    public function show(string $id)
    {
        return (response()->json(Flight::find($id), 200));
    }

    public function store(Request $request)
    {
        $flight = Flight::create(
            [
                "date" => $request->date,
                "departure" => $request->departure,
                "arrival" => $request->arrival,
                "airplane_id" => $request->airplaneId,
                "disposable" => $request->disposable
            ]
        );

        if ($flight->airplane->places != 0 && !$flight->disposable)
        {
            $flight->update(
                [
                    "disposable" => 1
                ]
            );
        }
        return (response()->json($flight, 200));
    }

    public function update(Request $request, string $id)
    {
        $flight = Flight::find($id);
        $flight->update(
            [
                "date" => $request->date,
                "departure" => $request->departure,
                "arrival" => $request->arrival,
                "airplane_id" => $request->airplaneId,
                "disposable" => $request->status
            ]
        );

        if ($flight->airplane->places != 0 && !$flight->disposable)
        {
            $flight->update(
                [
                    "disposable" => 1
                ]
            );
        }
        return (response()->json($flight, 200));
    }

    public function destroy(string $id)
    {
        Flight::find($id)->delete();
    }
}
