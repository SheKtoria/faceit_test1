<?php


namespace App\Repositories\Api;


use App\Models\Lot;
use App\Repositories\Interfaces\LotRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class LotRepository implements LotRepositoryInterface
{

    protected Lot $model;

    public function __construct(Lot $model)
    {
        $this->model = $model;
    }

    public function getAllPaginated(array $attributes): LengthAwarePaginator
    {
        $perPage = $attributes['per_page'] ?? 10;

        $model = clone $this->model;
        $lots = $model->where('status', 'open')
            ->paginate($perPage);

        return $lots;
    }

    public function store(array $attributes): Lot
    {
        $model = clone $this->model;
        $model->fill($attributes);
        $model->status = 'open';
        $model->save();

        return $model;
    }

    public function getMyLotsPaginated(array $attributes): LengthAwarePaginator
    {
        $perPage = $attributes['per_page'] ?? 10;

        $model = clone $this->model;
        $lots = $model->where('status', 'open')
            ->whereHas('offers', function ($q) use ($attributes) {
                $q->where('email', $attributes['email']);
            })
            ->paginate($perPage);

        return $lots;
    }
}
