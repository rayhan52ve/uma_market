<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\Union;
use App\Models\Upazila;

class DistrictUnionController extends Controller
{
    public function getDistricts($division_id)
    {
        $districts = District::where('division_id', $division_id)->get();
        return response()->json($districts);
    }

    public function getUpazila($district_id)
    {
        $upazilas = Upazila::where('district_id', $district_id)->get();
        return response()->json($upazilas);
    }

    public function getUnion($upazila_id)
    {
        $unions = Union::where('upazila_id', $upazila_id)->get();
        return response()->json($unions);
    }

    public function handleRequest(Request $request)
    {
        $selectedText = $request->input('selectedText');
    
        return "You selected: $selectedText";
    }
    
}
