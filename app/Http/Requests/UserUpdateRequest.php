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
            'name' => 'required|max:' . config('users.name.max'),
            'email' => 'required|email|unique:users,email,' . $this->user . ',id',
            'password' => 'nullable|min:' . config('users.password.min'),
            'password_confirmation' => 'same:password',
            'birthday' => 'nullable|date|before:today',
            'phone' => 'max:' . config('users.phone.max'),
            'address' => 'max:' . config('users.address.max'),
            'avatar' => 'max:' . config('users.avatar.max'),
        ];
    }
}
