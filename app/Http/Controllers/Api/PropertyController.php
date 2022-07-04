<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function index()
    {

        return response()->json([
            'data' => Property::all()
        ]);
    }

    public function store(PropertyRequest $request)
    {
        return response()->json([
            'data' => Property::create($request->all())
        ], 201);
    }


    public function update(PropertyRequest $request, Property $property)
    {

        return response()->json([
            'data' => tap($property)->update($request->all())
        ]);
    }


    public function destroy(Property $property)
    {
        $property->delete();

        return response([], 204);
    }
}
