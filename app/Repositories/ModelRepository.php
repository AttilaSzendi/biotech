<?php

namespace App\Repositories;

use App\Contracts\ModelRepositoryInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract class ModelRepository implements ModelRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    /**
     * @param array $input
     * @return Model
     */
    public function store(array $input): Model
    {
        return $this->model->newQuery()->create($input);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function list(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate();
    }

    /**
     * @param int $id
     * @param array $input
     * @return bool
     */
    public function updateById(int $id, array $input): bool
    {
        $Model = $this->model->newQuery()->findOrFail($id);

        return $Model->update($input);
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function deleteById(int $id): bool
    {
        $Model = $this->model->newQuery()->findOrFail($id);

        return $Model->delete();
    }
}
