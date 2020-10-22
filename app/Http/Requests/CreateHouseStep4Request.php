<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHouseStep4Request extends FormRequest
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
            'price' => 'required|numeric|between:1,9999|not_in:0'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'price.required' => 'Veuillez saisir le prix par nuit',
            'price.numeric' => 'Veuillez saisir uniquement des chiffres',
            'price.not_in' => 'Le prix ne doit pas être une valeur negative',
            'price.between' => 'Le prix doit être compris entre 1 et 9999 euros'
        ];
    }
}
