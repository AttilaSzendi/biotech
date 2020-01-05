<?php

namespace App\Repositories;

use App\Contracts\TagRepositoryInterface;
use App\Http\Requests\TagRequest;
use App\Tag;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TagRepository implements TagRepositoryInterface
{
    /**
     * @var Tag
     */
    protected $model;

    /**
     * TagRepository constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * @param int $id
     * @return Tag|Model
     */
    public function findById(int $id): Tag
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    /**
     * @param array $input
     * @return Tag|Model
     */
    public function store(array $input): Tag
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
        $tag = $this->model->newQuery()->findOrFail($id);

        return $tag->update($input);
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function deleteById(int $id): bool
    {
        $tag = $this->model->newQuery()->findOrFail($id);

        return $tag->delete();
    }
}
