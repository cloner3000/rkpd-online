<?php

namespace App\Http\Controllers;

use App\location\Villages;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function villages (Request $request, $districtId) {
        $villages = Villages::select('id as id', 'name as text')
            ->where('district_id', $districtId)
            ->orWhere('type', $request->input('type'))
            ->get()->chunk(100);
        return response()->json($villages);
    }
}
