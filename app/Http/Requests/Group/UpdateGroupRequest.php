<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
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
            'name' => [
                'required',
                'max:' . config('groups.name.max'),
                'unique:groups,name,' .$this->group->id,
            ],
            'description' => 'max:' . config('groups.description.max'),
            'image' => 'max:' . config('groups.image.max'),
        ];
    }

}
