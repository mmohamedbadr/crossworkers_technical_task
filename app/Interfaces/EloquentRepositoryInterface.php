<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{

    /**
     * get all models
     *
     * @param  mixed $columns
     * @param  mixed $relations
     * @param  mixed $paginate
     * @param  mixed $filters
     * @param  mixed $filtersWithRelation
     * @param  mixed $sort
     * @return Collection
     */

    public function all(
        array $columns = ['*'],
        array $relations = [],
        array $paginate = [],
        array $filters = [],
        array $filtersWithRelation = [],
        array $sort = []

    ): Collection;

    /**
     * get all trashed models
     *
     * @return Collection
     */
    public function allTrashed(): Collection;

    /**
     * findById
     *
     * @param  mixed $modelId
     * @param  mixed $columns
     * @param  mixed $relations
     * @param  mixed $appends
     * @return Model
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): Model;

    /**
     * findTrashedById
     *
     * @param  mixed $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): Model;

    /**
     * find Only Trashed By Id
     *
     * @param  mixed $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): Model;

    /**
     * create
     *
     * @param  mixed $payload
     * @return Model
     */
    public function create(array $payload): Model;

    /**
     * update
     *
     * @param  mixed $modelId
     * @param  mixed $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool;

    /**
     * deleteById
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * restoreById
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool;

    /**
     * permanentlyDeletedById
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function permanentlyDeletedById(int $modelId): bool;

}
