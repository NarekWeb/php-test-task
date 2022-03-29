<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'sometimes',
            'published'    => 'sometimes|boolean',
            'price_to'     => 'required_with:price_from|numeric|gt:price_from',
            'price_from'   => 'required_with:price_to|numeric|lt:price_to',
            'categories'   => 'sometimes|array|min:2|max:10',
            'categories.*' => 'sometimes|exists:categories,id',
        ];
    }
}
