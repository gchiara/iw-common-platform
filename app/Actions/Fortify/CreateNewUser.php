<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'org_name' => ['string', 'max:255', 'nullable'],
            'org_category' => ['required', 'string', 'max:255'],
        ])->validate();
        $contactConsent = 0;
        if(isset($input['contact_consent'])) {
            $contactConsent = 1;
        }
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'org_name' => $input['org_name'],
            'org_category' => $input['org_category'],
            'contact_consent' => $contactConsent
        ]);
    }
}
