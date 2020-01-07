<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface ModelRepositoryInterface
{
    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model;

    /**
     * @param array $input
     * @return Model
     */
    public function store(array $input): Model;

    /**
     * @return LengthAwarePaginator
     */
    public function list(): LengthAwarePaginator;

    /**
     * @param int $id
     * @param array $input
     * @return Model
     */
    public function updateById(int $id, array $input): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}
