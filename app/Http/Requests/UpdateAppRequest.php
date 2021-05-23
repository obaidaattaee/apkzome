<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAppRequest
 * @package App\Http\Requests
 */
class UpdateAppRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'extension' => ['required', 'string'],
//            'rate' => ['required'],
            'published_at' => ['required', 'date_format:Y-m-d'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['required'],
            'tags.*' => ['required', 'exists:tags,id'],
            'os_type_id' => ['required', 'exists:o_s_types,id'],
            'os_version_id' => ['required', 'exists:o_s_versions,id'],
            'owner_id' => ['required', 'exists:users,id'],
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => __('common.title'),
            'description' => __('common.description'),
        ];
    }
}
