<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Pour l'instant, tout le monde peut créer
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                'unique:products,name' // Le nom doit être unique
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

    /**
     * Messages d'erreur personnalisés
     */
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

    /**
     * Préparer les données avant validation
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? true : false,
        ]);
    }
}
