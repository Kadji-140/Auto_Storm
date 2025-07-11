<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // cette ligne signifie que nous allons utiliser la classe Rule de Laravel pour valider. Cette class Rule contient: 

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                // Unique sauf pour le produit actuel
                Rule::unique('products', 'name')->ignore($this->product) //cette ligne signifie que le nom doit être unique sauf pour le produit actuel
            ],
            'description' => [
                'required',
                'string',
                'min:10',
                'max:1000'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999.99',
                function($attribute,$value,$fail){
                    if($value>1000 && $this->input('stock')==0){
                        $fail('Le stock ne dois pas etre < 0 pour un motant de plus de 1000');
                    }
                }
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:10000'
            ],
            'is_active' => [
                'nullable',
                'boolean'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du produit est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 3 caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'name.unique' => 'Ce nom de produit existe déjà.',
            
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix doit être supérieur à 0.',
            'price.max' => 'Le prix ne peut pas dépasser 999 999,99€.',
            
            'stock.required' => 'Le stock est obligatoire.',
            'stock.integer' => 'Le stock doit être un nombre entier.',
            'stock.min' => 'Le stock ne peut pas être négatif.',
            'stock.max' => 'Le stock ne peut pas dépasser 10 000 unités.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? true : false,
        ]);
    }
}
