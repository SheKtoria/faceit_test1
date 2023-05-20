<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lots\IndexRequest;
use App\Http\Requests\Lots\MyLotsRequest;
use App\Http\Requests\Lots\StoreRequest;
use App\Http\Resources\LotResource;
use App\Http\Responses\ApiErrorResponse;
use App\Repositories\Api\LotRepository;
use Illuminate\Support\Facades\Log;
use Throwable;

class LotController extends Controller
{

    protected LotRepository $repository;

    /**
     * LotController constructor.
     */
    public function __construct(LotRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(IndexRequest $request)
    {
        try {
            $lots = $this->repository->getAllPaginated($request->validated());
        } catch (Throwable $e) {
            Log::error($e);
            return new ApiErrorResponse('Can\'t find lots', 400);
        }

        return LotResource::collection($lots);
    }

    public function store(StoreRequest $request)
    {
        try {
            $lot = $this->repository->store($request->validated());
        } catch (Throwable $e) {
            Log::error($e);
            return new ApiErrorResponse('Can\'t store this lot', 400);
        }

        return new LotResource($lot);
    }

    public function myLots(MyLotsRequest $request)
    {
        try {
            $lots = $this->repository->getMyLotsPaginated($request->validated());
        } catch (Throwable $e) {
            Log::error($e);
            return new ApiErrorResponse('Can\'t find your lots', 400);
        }

        return LotResource::collection($lots);
    }
}
