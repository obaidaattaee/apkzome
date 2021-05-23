<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppRequest extends FormRequest
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
//            'app.*.title' => ['required'],
//            'app.*.description' => ['required'],
            'title' => ['required' , 'string'],
            'description' => ['required' , 'string'],
            'extension' => ['required' , 'string'],
            'rate' => ['required' ],
            'published_at' => ['required' , 'date_format:Y-m-d'],
            'category_id' => ['required' , 'exists:categories,id'],
            'tags' => ['required'],
            'tags.*' => ['required' , 'exists:tags,id'],
            'os_type_id' => ['required' , 'exists:o_s_types,id'],
            'os_version_id' => ['required' , 'exists:o_s_versions,id'],
            'owner_id' => ['required' , 'exists:users,id'],
            "version.title" => ['required'],
            "version.published_at" => ['required'],
            "version.version_number" => ['required'],
            "version.original_link" => ['required'],
            "version.extension" => ['required'],
            "version.size" => ['required'],
            "version.sort_number" => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('common.title'),
            'description' => __('common.description'),
        ];
    }
}
