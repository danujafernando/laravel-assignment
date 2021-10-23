<?php

namespace App\Http\Requests;

use App\Rules\CheckPinValid;
use Illuminate\Foundation\Http\FormRequest;

class UserVerifyRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                'exists:App\UserPin,email'
            ],
            'pin' => [
                'required',
                'string',
                'min:6',
                'max:6',
                new CheckPinValid($this->request->all()),
            ]
        ];
    }
}
