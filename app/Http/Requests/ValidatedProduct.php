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
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'price' => ['required', 'integer'],
            'barcode' => ['required', 'integer', 'unique:products'],
            'description' => ['string', 'max:255'],
            'category_id' => ['required', 'integer', 'in:1,2,3,4'],
            'material_id' => ['required', 'integer', 'in:1,2,3'],
            'photos.*' => ['image', 'max:2048'],
            'stock' => ['gt:0'],
            'active' => ['required', 'integer', 'in:0,1']
        ] ;  
    }

    public function messages()
    {
        return [
            'name.unique' => 'Ya existe un artículo con ese nombre.',
            'price.integer' => 'En el precio solo van números', 
            'barcode.unique' => 'Ya existe un artículo con el mismo código de barras.',
            'photos.*.image' => 'Las fotos pueden ser .jpg, .jpeg, .bmp, .png o .svg.',
            'photos.max' => 'El tamaño de archivo máximo para cada foto es de 2 MB.',
            'category_id.required' => 'Falta seleccionar la categoría.',
            'material_id.required' => 'Falta seleccionar el material.',
            'stock.gt' => 'El stock no puede ser negativo.',
            'active.required' => 'Falta determinar si está activo o no.'
        ];
    }
    
}
