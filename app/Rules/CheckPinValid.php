<?php

namespace App\Rules;

use App\UserPin;
use Illuminate\Contracts\Validation\Rule;

class CheckPinValid implements Rule
{
    public $request = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //expire at after 10 minutes
        $expired_at = strtotime(now()) - 60 * 10;
        $expired_at = date('Y-m-d H:s:i', $expired_at);

        return UserPin::where('email', $this->request['email'])
                        ->where('pin', $this->request['pin'])
                        ->where('created_at', '>', $expired_at)
                        ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The pin is invalid';
    }
}
