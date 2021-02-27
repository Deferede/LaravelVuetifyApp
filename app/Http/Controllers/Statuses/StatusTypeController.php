<?php

namespace App\Http\Controllers\Statuses;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusTypesRequest;
use App\Http\Resources\Statuses\StatusTypeResource;
use App\Http\Services\StatusService;
use App\Model\Status\StatusType;

class StatusTypeController extends Controller
{
    /**
     * @var StatusService
     */
    protected $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->middleware('permission:crm.status_types-list')->only(['index', 'show']);
        $this->middleware('permission:crm.status_types-create')->only(['store']);
        $this->middleware('permission:crm.status_types-edit')->only(['update']);
        $this->middleware('permission:crm.status_types-delete')->only(['delete']);

        $this->statusService = $statusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StatusTypeResource::collection(StatusType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return StatusTypeResource
     */
    public function store(StatusTypesRequest $request)
    {
        $type = $this->statusService->createStatusType($request->all());

        return StatusTypeResource::make($type)->additional([
            'message' => __('status.type_created', ['type' => $type->name])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Model $type
     * @return StatusTypeResource
     */
    public function show(StatusType $type)
    {
        return StatusTypeResource::make($type);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param StatusTypesRequest $request
     * @param StatusType $type
     * @return StatusTypeResource
     */
    public function update(StatusTypesRequest $request, StatusType $type)
    {
        $type = $this->statusService->updateStatusType($request->all(), $type);

        return StatusTypeResource::make($type)->additional([
            'message' => __('status.type_updated', ['type' => $type->name])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StatusType $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(StatusType $type)
    {
        $this->statusService->deleteStatusType($type);

        return response()->json(['message' => __('status.type_deleted')]);
    }
}
