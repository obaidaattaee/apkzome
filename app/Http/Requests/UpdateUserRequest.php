<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:users,id,' . $this->user->id . ',id'],
            'email' => ['required', 'email', 'unique:users,id,' . $this->user->id . ',id'],
            'roles' => ['required'],
            'roles.*' => ['required', 'exists:roles,id'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('common.name'),
            'email' => __('auth.common'),
            'roles' => __('common.roles'),
        ];
    }
}
