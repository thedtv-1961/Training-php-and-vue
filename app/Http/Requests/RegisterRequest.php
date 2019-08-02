<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:30|regex:' .config('users.name.regex'),
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|min:6|max:16',
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => trans('validation.msg.name'),
        ];
    }
}
