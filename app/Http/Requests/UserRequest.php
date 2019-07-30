<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:' . config('users.name.max'),
            'email' => 'required|email|unique:users',
            'password' => 'required|min:' . config('users.password.min'),
            'password_confirmation' => 'required|same:password',
            'birthday' => 'nullable|date|before:today',
            'phone' => 'max:' . config('users.phone.max'),
            'address' => 'max:' . config('users.address.max'),
            'avatar' => 'max:' . config('users.avatar.max'),
        ];
    }

}
