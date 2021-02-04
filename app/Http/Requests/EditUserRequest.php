<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class EditUserRequest extends FormRequest
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
            'nom' => 'required|min:2|max:100|regex:/^[\pL\s\-\']+$/u',
            'prenom' => 'required|min:2|max:100|regex:/^[\pL\s\-\']+$/u',
            'email' => 'required|max:100|unique:users,email,'.Auth::user()->id.',id',
            'newsletter' => 'boolean'
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
            'nom.required' => 'Saisir votre nom',
            'nom.min' => 'Saisir un nom à 2 caractères minimum',
            'nom.max' => 'Saisir un nom ne dépassant pas 100 caractères',
            'nom.regex' => "Le nom que vous avez saisie n'est pas valide",
            'prenom.required' => 'Saisir votre nom',
            'prenom.min' => 'Saisir un prenom à 2 caractères minimum',
            'prenom.max' => 'Saisir un prenom ne dépassant pas 100 caractères',
            'prenom.regex' => "Le prenom que vous avez saisie n'est pas valide",
            'email.required' => "Saisir un email",
            'email.unique' => "L'email que vous avez saisie est déjà utilisée",
            'email.max' => "L'email ne doit pas dépasser 100 caractères",
            'email.email' => "L'email n'est pas valide",
            'newsletter.boolean' => 'Veuillez cocher ou décocher la case'
        ];
    }
}
