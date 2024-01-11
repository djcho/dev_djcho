<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // ProductControoler의 조건과 더불어 신규조건을 추가
        return [
            'name' => 'required|max:63',
            'content' => 'required|max:255',
            'call' => 'required|regex:/(\d{2,3})-(\d{3,4})-(\d{4})/'
        ];
    }

    public function messages(){

        return [
            'name.required' => '제목이 비어있습니다.',
            'name.max' => '제목은 63자이하입니다.',
            'content.required' => '내용이 비어있습니다.',
            'content.max' => '내용은 255자 이하입니다.',
            'call.required' => '전화번호가 비어있습니다.',
            'call.regex' => '올바른 전화번호 형태가 아닙니다.',
    ];
    }
}
