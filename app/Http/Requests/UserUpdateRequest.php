<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'user_name' => [
                'string',
                'max:20',
                'min:4'
            ],
            'name' => [
                'nullable',
                'string',
                'max:255'
            ],
            'avatar' => [
                'sometimes',
                'mimes:jpg,png,jpeg,gif',
                'dimensions:min_width=256,min_height=256'
            ]
        ];
    }
}
