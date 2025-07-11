<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> [
                'required',
                'string',
                'min:3',
                'max:55'
            ],
            'prenom'=> ['required,string,min:3,max:55'],
            'email'=> ['required, string, min:5','max:120','unique:users,email'],
            'password'=> ['resuired','text','min:7','max:200']
        ];
    }

    public function messages()
    {
        return [
            'name.require'=>'Le nom est requis',
            'name.string'=>'Entrer une chaine de charactere',
            'name.min'=>'Longueur minimale est de 3',
            'name.max'=>'Longueur max est de 55',

            'prenom.require'=>'Le nom est requis',
            'prenom.string'=>'Entrer une chaine de charactere',
            'prenom.min'=>'Longueur minimale est de 3',
            'prenom.max'=>'Longueur max est de 55',

            'email.require'=>'Le nom est requis',
            'email.string'=>'Entrer une chaine de charactere',
            'email.min'=>'Longueur minimale est de 3',
            'email.max'=>'Longueur max est de 55',

            'password.require'=>'Le nom est requis',
            'password.string'=>'Entrer une chaine de charactere',
            'password.min'=>'Longueur minimale est de 7',
            'password.max'=>'Longueur max est de 200',


            ];
    }
}
