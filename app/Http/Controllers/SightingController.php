<?php

namespace App\Http\Controllers;

use DB;
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
            if (!empty($tempTags)) {
                $sighting->tags = implode(",", $tempTags);
            } else {
                $sighting->tags = '';
            }
            $tempTags = [];
        }
        return response()->json($sightings, 200);
    }

    public function showOneSighting($id)
    {
        $sighting = Sighting::find($id);
        foreach ($sighting->tags as $tag) {
            $tempTags[] = $tag->tag_text;
        }
        unset($sighting->tags);
        if (!empty($tempTags)) {
            $sighting->tags = implode(",", $tempTags);
        } else {
            $sighting->tags = '';
        }

        return response()->json($sighting, 200);
    }

    public function create(Request $request)
    {
        $sighting = Sighting::create($request->all());
        $return = [
            'success' => true,
            'message' => 'Sighting has been successfully created. Congratulations on catching a glimpse of the elusive and majestic Sasquatch!'
        ];
        return response()->json($return, 201);
    }

    public function update($id, Request $request)
    {
        $sighting = Sighting::findOrFail($id);
        $sighting->update($request->all());
        $return = [
            'success' => true,
            'message' => 'Sighting successfully updated. Thank you for your contribution and Hail Sasquatch!'
        ];

        return response()->json($return, 200);
    }

    public function delete($id)
    {
        Sighting::findOrFail($id)->delete();
        $return = [
            'success' => true,
            'message' => 'Sighting deleted. Only the truly blessed have actually seen the great Sasquatch.'
        ];
        return response($return, 200);
    }

    public function distanceBetweenTwo($id1, $id2)
    {
        $sighting1 = Sighting::find($id1);
        $sighting2 = Sighting::find($id2);

        if (empty($sighting1) || empty($sighting2)) {
            $return = [
                'success' => false,
                'message' => 'One or more of those sightings does not exist. Do not try to fool the Sasquatch!'
            ];
        } else {
            $return = 
                Sighting::select(
                    DB::raw('ST_Distance((SELECT position FROM sightings WHERE id = ?), (SELECT position FROM sightings WHERE id = ?)) AS distance'))
                ->setBindings([$id1, $id2])
                ->first();
        }

        return response()->json($return, 200);
    }



}