<?php

namespace Modules\AdminStatuses\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AdminStatuses\Entities\StatusCategory;
use Modules\AdminStatuses\Http\Requests\StatusCategoriesRequest;
use Modules\AdminStatuses\Repositories\CategoriesRepository;
use Modules\AdminStatuses\Services\StatusService;
use Modules\AdminStatuses\Transformers\StatusCategoryResource;

class StatusCategoryController extends BaseController
{
    private StatusService $statusService;
    private CategoriesRepository $repository;

    public function __construct(StatusService $statusService, CategoriesRepository $repository)
    {
        $this->middleware('permission:crm.status_categories-list')->only(['index', 'show']);
        $this->middleware('permission:crm.status_categories-create')->only(['store']);
        $this->middleware('permission:crm.status_categories-edit')->only(['update']);
        $this->middleware('permission:crm.status_categories-delete')->only(['delete']);

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
        $statusCategories = $this->repository->all();
        return $this->sendResponse(StatusCategoryResource::collection($statusCategories));
    }

    public function allList()
    {
        $statusCategories = $this->repository->all(false);
        return $this->sendResponse(StatusCategoryResource::collection($statusCategories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StatusCategoriesRequest $request
     * @return JsonResponse|JsonResource
     */
    public function store(StatusCategoriesRequest $request)
    {
        $category = $this->statusService->createStatusCategory($request->all());

        return $this->sendResponse(StatusCategoryResource::make($category), __('status.category_created', ['category' => $category->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param StatusCategory $category
     * @return JsonResponse|JsonResource
     */
    public function show(StatusCategory $category)
    {
        return $this->sendResponse(StatusCategoryResource::make($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatusCategoriesRequest $request
     * @param StatusCategory $category
     * @return JsonResponse|JsonResource
     */
    public function update(StatusCategoriesRequest $request, StatusCategory $category)
    {
        $category = $this->statusService->updateStatusCategory($request->all(), $category);

        return $this->sendResponse(StatusCategoryResource::make($category), __('status.category_updated', ['category' => $category->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StatusCategory $category
     * @return JsonResponse
     */
    public function destroy(StatusCategory $category)
    {
        $this->statusService->deleteStatusCategory($category);

        return $this->sendResponse(null, __('status.category_deleted'));
    }
}
