<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Sighting;
use Illuminate\Http\Request;

class SightingController extends Controller
{

    public function showAllSightings()
    {
        $sightings = Sighting::all();
        foreach ($sightings as $sighting) {
            foreach ($sighting->tags as $tag) {
                $tempTags[] = $tag->tag_text;
            }
            unset($sighting->tags);
            $sighting->tags = implode(",", $tempTags);
            $tempTags = [];
        }
        return response()->json($sightings);
    }

    public function showOneSighting($id)
    {
        $sighting = Sighting::find($id);
        foreach ($sighting->tags as $tag) {
            $tempTags[] = $tag->tag_text;
        }
        unset($sighting->tags);
        $sighting->tags = implode(",", $tempTags);

        return response()->json($sighting);
    }

    public function create(Request $request)
    {
        $tags = explode(',', $request->tags);
        unset($request->tags);

        $sighting = Sighting::create($request->all());

        foreach ($tags as $tag) {
            $newtag = Tag::firstOrNew(['tag_text' => $tag]);
            $sighting->tags()->attach($newtag);
        }

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