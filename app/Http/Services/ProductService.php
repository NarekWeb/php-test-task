<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    protected Product $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @return array|Collection
     */
    public function all(): array|Collection
    {
        return $this->model
            ->with('categories:id,name')
            ->get();
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function create($data): Product
    {
        DB::beginTransaction();

        try {
            $product = $this->model->create([
                'name'       => $data['name'],
                'price_from' => $data['price_from'],
                'price_to'   => $data['price_to'],
                'published' => $data['published'],
            ]);

            $product->categories()->attach($data['categories']);

            DB::commit();

            return  $product->load('categories');
        } catch (\Exception $e) {
            DB::rollback();

            throw new \Exception('Product has not been created. Please try again');
        }
    }

    /**
     * @param $data
     * @param $product
     * @return mixed
     * @throws \Exception
     */
    public function update($data, $product): mixed
    {
        DB::beginTransaction();

        try {
            $product->update($data);

            if(isset($data['categories'])){
                $product->categories()->sync($data['categories']);
            }

            DB::commit();

            return  $product->load('categories');
        } catch (\Exception $e) {
            DB::rollback();

            throw new \Exception('Product has not been created. Please try again');
        }
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
