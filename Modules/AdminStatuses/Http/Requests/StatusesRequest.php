<?php

namespace Modules\AdminStatuses\Http\Requests;

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
                    'priority' => 'required|numeric|unique:statuses',
                    'status_type_id' => 'required|exists:status_types,id',
                    'status_category_id' => 'required|exists:status_categories,id',
                ];
                break;
            case "PATCH":
            case "PUT":
                $rules = [
                    'name' => 'required|unique:statuses,name,' . $this->route('status')->id,
                    'priority' => 'required|numeric|unique:statuses,priority,' . $this->route('status')->id,
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

    public function getValidatorInstance()
    {
        $this->prepareType();
        $this->prepareCategory();

        return parent::getValidatorInstance();
    }

    private function prepareType()
    {
        if ($this->has('type.id')){
            $this->merge(['status_type_id' => $this->type['id']]);
        } elseif ($this->has('type')) {
            $this->merge(['status_type_id' => $this->type]);
        }

    }

    private function prepareCategory()
    {
        if ($this->has('category.id')){
            $this->merge(['status_category_id' => $this->category['id']]);
        } elseif ($this->has('category')) {
            $this->merge(['status_category_id' => $this->category]);
        }
    }
}
