<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApprovalResource;
use App\Models\Approval;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ApprovalResource::collection(Approval::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $approval = Approval::create(
            $request->only((new Approval())->getFillable())
        );

        return new ApprovalResource($approval);
    }

    /**
     * Display the specified resource.
     */
    public function show(Approval $approval)
    {
        return new ApprovalResource($approval);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Approval $approval)
    {
        $approval->update(
            $request->only((new Approval())->getFillable())
        );

        return new ApprovalResource($approval);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approval $approval)
    {
        $approval->delete();

        return response()->noContent();
    }
}
