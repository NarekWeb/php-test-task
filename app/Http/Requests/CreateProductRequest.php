<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name'         => 'required',
            'published'      => 'required|boolean',
            'price_to'     => 'required|numeric|gt:price_from',
            'price_from'   => 'required|numeric|lt:price_to',
            'categories'   => 'required|array|min:2|max:10',
            'categories.*' => 'required|exists:categories,id',
        ];
    }
}
