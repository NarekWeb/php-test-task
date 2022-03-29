<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'       => $this->name,
            'published'  => $this->published,
            'price_from' => $this->price_from,
            'price_to'   => $this->price_to,
            'categories' => $this->categories->map(function ($category) {
                return [
                    'id'   => $category->id,
                    'name' => $category->name,
                ];
            }),
        ];
    }
}
