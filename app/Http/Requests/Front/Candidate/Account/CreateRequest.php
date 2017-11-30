<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Account;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'nombre' => 'required|min:4',
            'apellidoPaterno' => 'sometimes|required|min:3',
            'correoElectronico' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ];
    }
}
