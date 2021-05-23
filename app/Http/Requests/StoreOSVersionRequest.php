<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOSVersionRequest extends FormRequest
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
            'os_type_id' => ['required' , 'exists:o_s_types,id'],
            'version' => ['required' , 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'os_type_id' => __('common.os_type'),
            'version' => __('common.version'),
        ];
    }
}
