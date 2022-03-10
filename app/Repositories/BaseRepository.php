<?php

namespace App\Repositories;

use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{

    protected $model;
    protected $filters;
    protected $filtersWithRelation;
    protected $sort;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->filters = [];
        $this->filtersWithRelation = [];

    }

    /**
     * get all models
     *
     * @param  mixed $columns
     * @param  mixed $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = [], array $paginate = [], $filters = [], $filtersWithRelation = [], $sort = []): Collection
    {
        $this->sort = [
            "sortBy" => "updated_at",
            "sortOrder" => 'desc',
        ];
        $this->filters = $filters;
        $this->filtersWithRelation = $filtersWithRelation;
        $model = $this->model->query();
        if (!empty($filters)) {
            $model = $this->applyFiltersToQuery($model);
        }
        if (!empty($filtersWithRelation)) {
            $model = $this->applyFilterWithRelation($model);
        }
        if (!empty($paginate)) {
            if (isset($paginate['current_page'])) {
                $model = $model->skip(($paginate['current_page'] - 1) * $paginate['per_page']);
            }
            if (isset($paginate['per_page'])) {
                $model = $model->take($paginate['per_page']);
            }
        }
        if (!empty($sort)) {
            if (isset($sort['sort_by'])) {
                $this->sort['sortBy'] = $sort['sort_by'];
            }
            if (isset($sort['sort_order'])) {
                $this->sort['sortOrder'] = $sort['sort_order'];
            };
        }

        $model = $this->applySort($model);
        return $model->with($relations)->get($columns);
    }

    /**
     * applyFiltersToQuery
     *
     * @param  mixed $query
     * @return object
     */
    protected function applyFiltersToQuery($query): object
    {
        foreach ($this->filters as $field => $value) {
            if (is_array($value)) {
                $query->whereIn($field, (array) $value);
            } else {
                $query->where($field, $value);
            }
        }
        return $query;
    }

    /**
     * applyFiltersToQuery
     *
     * @param  mixed $query
     * @return object
     */
    protected function applySort($query): object
    {
        $query->orderBy($this->sort['sortBy'], $this->sort['sortOrder']);
        return $query;
    }

    /**
     * applyFiltersToQuery
     *
     * @param  mixed $query
     * @return object
     */
    protected function applyFilterWithRelation($query, $filters = []): object
    {
        foreach ($this->filtersWithRelation as $field => $value) {
            return $query->whereHas($field, function ($q) use ($value) {
                foreach ($value as $f => $v) {
                    return $q->WhereIn($f, (array) $v);
                }
            });
        }
    }
    /**
     * get all trashed models
     *
     * @return Collection
     */
    public function allTrashed(): Collection
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * findById
     *
     * @param  mixed $modelId
     * @param  mixed $columns
     * @param  mixed $relations
     * @param  mixed $appends
     * @return Model
     */
    public function findById(int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []): Model {
        return $this->model->select($columns)
            ->with($relations)
            ->findOrFail($modelId)
            ->append($appends);
    }

    /**
     * findTrashedById
     *
     * @param  mixed $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): Model
    {
        return $this->model->withTrashed()->findOrFail($modelId);
    }

    /**
     * find Only Trashed By Id
     *
     * @param  mixed $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): Model
    {
        return $this->model->onlyTrashed()->findOrFail($modelId);
    }

    /**
     * create
     *
     * @param  mixed $payload
     * @return Model
     */
    public function create(array $payload): Model
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    /**
     * update
     *
     * @param  mixed $modelId
     * @param  mixed $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);
        return $model->update($payload);
    }

    /**
     * deleteById
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }

    /**
     * restoreById
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool
    {
        return $this->findOnlyTrashedById($modelId)->restore();
    }

    /**
     * permanentlyDeletedById
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function permanentlyDeletedById(int $modelId): bool
    {
        return $this->findTrashedById($modelId)->forceDelete();
    }
}
