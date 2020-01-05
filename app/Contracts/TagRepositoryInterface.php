<?php

namespace App\Contracts;

use App\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface TagRepositoryInterface
{
    /**
     * @param int $id
     * @return Tag|Model
     */
    public function findById(int $id): Tag;

    /**
     * @param array $input
     * @return Tag
     */
    public function store(array $input): Tag;

    /**
     * @return LengthAwarePaginator
     */
    public function list(): LengthAwarePaginator;

    /**
     * @param int $id
     * @param array $input
     * @return bool
     */
    public function updateById(int $id, array $input): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}
