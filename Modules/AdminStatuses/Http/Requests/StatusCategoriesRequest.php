<?php

namespace Modules\AdminStatuses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusCategoriesRequest extends FormRequest
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
            case "GET":
                // todo
                break;
            case "POST":
                $rules = [
                    'name' => 'required|unique:status_categories',
                ];
                break;
            case "PATCH":
            case "PUT":
                $rules = [
                    'name' => 'required|unique:status_categories,name,' . $this->route('category')->id,
                ];
                break;
            case "DELETE":
            default:
                break;
        }
        return $rules;
    }
}
