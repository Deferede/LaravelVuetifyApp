<?php

namespace Modules\AdminStatuses\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AdminStatuses\Entities\StatusType;
use Modules\AdminStatuses\Http\Requests\StatusTypesRequest;
use Modules\AdminStatuses\Repositories\TypesRepository;
use Modules\AdminStatuses\Services\StatusService;
use Modules\AdminStatuses\Transformers\StatusTypeResource;

class StatusTypeController extends BaseController
{
    private StatusService $statusService;
    private TypesRepository $repository;

    public function __construct(StatusService $statusService, TypesRepository $repository)
    {
        $this->middleware('permission:crm.status_types-list')->only(['index', 'show']);
        $this->middleware('permission:crm.status_types-create')->only(['store']);
        $this->middleware('permission:crm.status_types-edit')->only(['update']);
        $this->middleware('permission:crm.status_types-delete')->only(['delete']);

        $this->statusService = $statusService;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|JsonResource
     */
    public function index()
    {
        $statusTypes = $this->repository->all();
        return $this->sendResponse(StatusTypeResource::collection($statusTypes));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StatusTypesRequest $request
     * @return JsonResponse|JsonResource
     */
    public function store(StatusTypesRequest $request)
    {
        $type = $this->statusService->createStatusType($request->all());

        return $this->sendResponse(StatusTypeResource::make($type), __('status.type_created', ['type' => $type->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param StatusType $type
     * @return JsonResponse|JsonResource
     */
    public function show(StatusType $type)
    {
        return $this->sendResponse(StatusTypeResource::make($type));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param StatusTypesRequest $request
     * @param StatusType $type
     * @return JsonResponse|JsonResource
     */
    public function update(StatusTypesRequest $request, StatusType $type)
    {
        $type = $this->statusService->updateStatusType($request->all(), $type);

        return $this->sendResponse(StatusTypeResource::make($type), __('status.type_updated', ['type' => $type->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StatusType $type
     * @return JsonResponse
     */
    public function destroy(StatusType $type)
    {
        $this->statusService->deleteStatusType($type);

        return $this->sendResponse(null, __('status.type_deleted', ['type' => $type->name]));
    }
}
