<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketAssignmentResource;
use App\Models\TicketAssignment;
use Illuminate\Http\Request;

class TicketAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TicketAssignmentResource::collection(TicketAssignment::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticketAssignment = TicketAssignment::create(
            $request->only((new TicketAssignment())->getFillable())
        );

        return new TicketAssignmentResource($ticketAssignment);
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketAssignment $ticketAssignment)
    {
        return new TicketAssignmentResource($ticketAssignment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketAssignment $ticketAssignment)
    {
        $ticketAssignment->update(
            $request->only((new TicketAssignment())->getFillable())
        );

        return new TicketAssignmentResource($ticketAssignment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketAssignment $ticketAssignment)
    {
        $ticketAssignment->delete();

        return response()->noContent();
    }
}
