<?php

namespace Modules\AdminUsers\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserSettingsRequest extends FormRequest
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
     * @param Request $request
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
                    'username' => 'required|unique:users,username',
                    'email' => 'sometimes|nullable|email|unique:users,email',
                    'role' => 'sometimes|exists:roles,id',
                    'password' => 'required|min:5',
                ];
                break;
            case "PATCH":
            case "PUT":
                $rules = [
                    'username' => 'sometimes|unique:users,username,' . $this->route('user')->id,
                    'email' => 'sometimes|nullable|email|unique:users,email,' . $this->route('user')->id,
                    'role' => 'sometimes|exists:roles,id',
                    'password' => 'sometimes|min:5',
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
        $this->prepareRole();

        return parent::getValidatorInstance();
    }

    private function prepareRole()
    {
        if ($this->has('role.id')){
            $this->merge(['role' => $this->role['id']]);
        }
    }
}
