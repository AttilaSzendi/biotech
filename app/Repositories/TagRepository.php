<?php

namespace App\Repositories;

use App\Contracts\TagRepositoryInterface;
use App\Tag;

class TagRepository extends ModelRepository implements TagRepositoryInterface
{
    /**
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
}
