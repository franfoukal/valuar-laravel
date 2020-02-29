<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatedProduct extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'barcode' => ['required', 'integer'],
            'description' => ['string', 'max:255'],
            'category_id' => ['integer', 'in:1,2,3,4'],
            'material_id' => ['integer', 'in:1,2,3'],
            'photos.*' => ['image', 'max:2048'],
            'stock' => ['min:0'],
            'active' => ['integer', 'in:0,1']
        ];
    }
}
