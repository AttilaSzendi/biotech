<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Product;

/**
 * @method Product store(array $input) : Model
 */
class ProductRepository extends ModelRepository implements ProductRepositoryInterface
{
    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
