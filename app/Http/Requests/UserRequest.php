<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = $this->route()->user;

        $unique = 'unique:users,email';

        if ($user!==null){
            $unique.=','.$user->id;
        }

        return [
            'name' => 'required',
            'email' => 'required|email|'.$unique,
            'phone' => 'required',
            'group_id' => ['required', function($attributes, $value, $fail){
                if ($value==0){
                    $fail('Vui lòng chọn nhóm');
                }
            }],
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã tồn tại'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'group_id' => 'Nhóm',
            'status' => 'Trạng thái'
        ];
    }
}
