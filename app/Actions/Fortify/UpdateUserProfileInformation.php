<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */
    public function update($user, array $input)
    {
        if (config("ldap.enabled")) {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'department_id' => [Rule::exists("departments", "id"), "nullable"],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            ])->validateWithBag('updateProfileInformation');
        }
        else {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'department_id' => [Rule::exists("departments", "id"), "nullable"],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            ])->validateWithBag('updateProfileInformation');
        }

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        }
        else {
            if (config("ldap.enabled")) {
                $user->forceFill([
                    'name' => $input['name'],
                    'department_id' => empty($input['department_id']) ? null : $input["department_id"],
                ])->save();
            }
            else {
                $user->forceFill([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'department_id' => empty($input['department_id']) ? null : $input["department_id"],
                ])->save();
            }
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
