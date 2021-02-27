<?php

namespace App\Http\Controllers\Statuses;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusesRequest;
use App\Http\Resources\Statuses\StatusResource;
use App\Http\Services\StatusService;
use App\Model\Status\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->middleware('permission:crm.statuses-list')->only(['index', 'show']);
        $this->middleware('permission:crm.statuses-create')->only(['store']);
        $this->middleware('permission:crm.statuses-edit')->only(['update']);
        $this->middleware('permission:crm.statuses-delete')->only(['delete']);

        $this->statusService = $statusService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StatusResource::collection(Status::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return StatusResource
     */
    public function store(StatusesRequest $request)
    {
        $status = $this->statusService->createStatus($request->all());


            return StatusResource::make($status)->additional([
                'message' => __('status.created'),
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     * @return StatusResource
     */
    public function show(Status $status)
    {
        return StatusResource::make($status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatusesRequest $request
     * @param Status $status
     * @return StatusResource
     */
    public function update(StatusesRequest $request, Status $status)
    {
        $status = $this->statusService->updateStatus($request->all(), $status);

        return StatusResource::make($status)->additional([
            'message' => __('status.created'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Status $status)
    {
        $this->statusService->deleteStatus($status);

        return response()->json(['message' => __('status.deleted')]);
    }
}
