<?php

namespace App\Http\Requests;

use App\UserInvitation;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'token' => [
                'required',
                'string',
                'min:32',
                'max:32',
                new UserInvitation($this->request->all())
            ],
            'email' => [
                'required',
                'string',
                'exists:App\UserInvitation,email',
            ],
            'user_name' => [
                'required',
                'string',
                'min:4',
                'max:20'
            ],
            'password' => [
                'required',
                'string',
                'min:8', 
                'confirmed'
            ]
        ];
    }
}
