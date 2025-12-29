<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Fortify;
use App\Models\User;

class CustomLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            Fortify::username() => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * After validation, check if the user is an Admin.
     */
    protected function passedValidation()
    {
        $usernameField = Fortify::username();
        $user = User::where($usernameField, $this->input($usernameField))->first();

        if ($user && $user->role !== 'Admin') {
            // Stop the login and throw an error
            abort(403, 'Only admins can log in.');
        }
    }
}
