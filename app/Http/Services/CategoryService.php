<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{
    protected Category $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->model->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data): Category
    {
        return $this->model->create([
            'name' => $data['name'],
        ]);
    }

    /**
     * @throws \Exception
     */
    public function delete(Category $category): void
    {
        if ($category->products()->count()) {
            throw new \Exception('you can not delete a category that has a product');
        }

        $category->delete();
    }
}
