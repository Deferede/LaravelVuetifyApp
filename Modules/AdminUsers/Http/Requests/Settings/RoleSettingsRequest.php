<?php

namespace Modules\AdminUsers\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class RoleSettingsRequest extends FormRequest
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
        $rules = [];

        switch ($this->getMethod()) {
            case "POST":
                $rules['permissions'] = ['sometimes', 'array', 'exists:permissions,id'];
                break;
            default:
                break;
        }
        return $rules;
    }
}
