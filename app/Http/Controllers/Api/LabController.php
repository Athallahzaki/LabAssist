<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabResource;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LabResource::collection(Lab::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lab = Lab::create(
            $request->only((new Lab())->getFillable())
        );

        return new LabResource($lab);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lab $lab)
    {
        return new LabResource($lab);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lab $lab)
    {
        $lab->update(
            $request->only((new Lab())->getFillable())
        );

        return new LabResource($lab);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lab $lab)
    {
        $lab->delete();

        return response()->noContent();
    }
}
