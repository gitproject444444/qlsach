<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TimeRule;

class BorrowRequest extends FormRequest
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
            'date' => ['required', new TimeRule(),'date']
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'date.required' => 'Vui lòng chọn ngày trả sách',
            'date.date' => 'Không đúng định dạng ngày',
        ];
    }
}
