<?php

namespace App\Http\Controllers\Statuses;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusCategoriesRequest;
use App\Http\Resources\Statuses\StatusCategoryResource;
use App\Http\Services\StatusService;
use App\Model\Status\StatusCategory;


class StatusCategoryController extends Controller
{
    /**
     * @var StatusService
     */
    protected $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->middleware('permission:crm.status_categories-list')->only(['index', 'show']);
        $this->middleware('permission:crm.status_categories-create')->only(['store']);
        $this->middleware('permission:crm.status_categories-edit')->only(['update']);
        $this->middleware('permission:crm.status_categories-delete')->only(['delete']);

        $this->statusService = $statusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StatusCategoryResource::collection(StatusCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StatusCategoriesRequest $request
     * @return StatusCategoryResource
     */
    public function store(StatusCategoriesRequest $request)
    {
        $category = $this->statusService->createStatusCategory($request->all());

        return StatusCategoryResource::make($category)->additional([
            'message' => __('status.category_created', ['category' => $category->name])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param StatusCategory $category
     * @return StatusCategoryResource
     */
    public function show(StatusCategory $category)
    {
        return StatusCategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatusCategoriesRequest $request
     * @param StatusCategory $category
     * @return StatusCategoryResource
     */
    public function update(StatusCategoriesRequest $request, StatusCategory $category)
    {
        $category = $this->statusService->updateStatusCategory($request->all(), $category);

        return StatusCategoryResource::make($category)->additional([
            'message' => __('status.category_updated', ['category' => $category->name])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StatusCategory $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(StatusCategory $category)
    {
        $this->statusService->deleteStatusCategory($category);

        return response()->json(['message' => __('status.category_deleted')]);
    }
}
