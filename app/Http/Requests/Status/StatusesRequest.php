<?php

namespace App\Http\Requests\Status;

use Illuminate\Foundation\Http\FormRequest;

class StatusesRequest extends FormRequest
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
                    'name' => 'required|unique:statuses',
                    'weight' => 'required|numeric|unique:statuses',
                    'status_type_id' => 'required|exists:status_types,id',
                    'status_category_id' => 'required|exists:status_categories,id',
                ];
                break;
            case "PATCH":
            case "PUT":
                $rules = [
                    'name' => 'required|unique:statuses,name,' . $this->route('status')->id,
                    'weight' => 'required|numeric|unique:statuses,weight,' . $this->route('status')->id,
                    'status_type_id' => 'required|exists:status_types,id',
                    'status_category_id' => 'required|exists:status_categories,id',
                ];
                break;
            case "DELETE":
            default:
                break;
        }
        return $rules;
    }
}
