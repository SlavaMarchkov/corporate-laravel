<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo('UPDATE_USER');
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('password', 'required|min:6|confirmed', function ($input) {
            // проверяем пароль на совпадение только при создании либо при изменении, 
            // когда редактируем пользователя
            if ((empty($input->password) && $this->route()->getName() !== 'admin.users.update') || (!empty($input->password))) {                
                return TRUE;
            }

            return FALSE;
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = isset($this->route()->parameter('user')->id) 
                ? $this->route()->parameter('user')->id
                : NULL;
        
        return [
            'name' => 'required|max:50',
            'login' => 'required|max:50',            
            'role_id' => 'required|integer',
            'email' => 'required|email|max:50|unique:users,email,' . $id,
        ];
    }
}
