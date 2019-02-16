<?php

namespace App\Http\Controllers;

use App\Sighting;
use Illuminate\Http\Request;

class SightingController extends Controller
{

    public function showAllSightings()
    {
        return response()->json(Sighting::all());
    }

    public function showOneAuthor($id)
    {
        return response()->json(Sighting::find($id));
    }

    public function create(Request $request)
    {
        $sighting = Sighting::create($request->all());

        return response()->json($sighting, 201);
    }

    public function update($id, Request $request)
    {
        $sighting = Sighting::findOrFail($id);
        $sighting->update($request->all());

        return response()->json($sighting, 200);
    }

    public function delete($id)
    {
        Sighting::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}