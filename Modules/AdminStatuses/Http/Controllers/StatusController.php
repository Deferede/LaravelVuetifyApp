<?php

namespace Modules\AdminStatuses\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AdminStatuses\Entities\Status;
use Modules\AdminStatuses\Http\Requests\StatusesRequest;
use Modules\AdminStatuses\Repositories\StatusesRepository;
use Modules\AdminStatuses\Services\StatusService;
use Modules\AdminStatuses\Transformers\StatusResource;

class StatusController extends BaseController
{
    private StatusService $statusService;
    private StatusesRepository $repository;

    public function __construct(StatusService $statusService, StatusesRepository $repository)
    {
        $this->middleware('permission:crm.statuses-list')->only(['index', 'show']);
        $this->middleware('permission:crm.statuses-create')->only(['store']);
        $this->middleware('permission:crm.statuses-edit')->only(['update']);
        $this->middleware('permission:crm.statuses-delete')->only(['delete']);

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
        $statuses = $this->repository->all();
        return $this->sendResponse(StatusResource::collection($statuses));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StatusesRequest $request
     * @return JsonResponse|JsonResource
     */
    public function store(StatusesRequest $request)
    {
        $status = $this->statusService->createStatus($request->all());
        return $this->sendResponse(StatusResource::make($status), __('status.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     * @return JsonResponse|JsonResource
     */
    public function show(Status $status)
    {
        return $this->sendResponse(StatusResource::make($status));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatusesRequest $request
     * @param Status $status
     * @return JsonResponse|JsonResource
     */
    public function update(StatusesRequest $request, Status $status)
    {
        $status = $this->statusService->updateStatus($request->all(), $status);
        return $this->sendResponse(StatusResource::make($status), __('status.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return JsonResponse
     */
    public function destroy(Status $status)
    {
        $this->statusService->deleteStatus($status);
        return $this->sendResponse(null, __('status.deleted'));
    }
}
