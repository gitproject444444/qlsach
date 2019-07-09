<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255','unique:books,name'],
            'author' => 'required',
            // 'password' => ['required', 'string', 'min:3', 'confirmed'],
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sách',
            'name.unique' => 'Tên sách trùng, vui lòng chọn sách khác',
            'author.required' => 'Vui lòng chọn tác giả cho sách',


            // 'password.required' => 'yêu cầu nhập mật khẩu',
            // 'password.min' => 'mật khẩu có ít nhất 3 ký tự',
            // 'password.confirmed' => 'Yêu cầu xác thực mật khẩu chính xác',
            // 'email.required' => 'Yêu cầu nhập email vào',
            // 'email.email' => 'Yêu cầu nhập đúng định dạng email'
        ];
    }
}
