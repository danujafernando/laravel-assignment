<?php

namespace App\Rules;

use App\UserInvitation;
use Illuminate\Contracts\Validation\Rule;

class CheckInvitationTokenValid implements Rule
{
    private $request;
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
        //expire at after one hour
        $expired_at = strtotime(now()) - 60 * 60;
        $expired_at = date('Y-m-d H:s:i', $expired_at);

        return UserInvitation::where('email', $this->request['email'])
                        ->where('token', $this->request['token'])
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
        return 'The token is invalid';
    }
}
