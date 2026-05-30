<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:1,2,3'],
            'email' => ['required', 'email', 'max:255'],
            'tel1' => ['required', 'regex:/^[0-9]{2,4}$/'],
            'tel2' => ['required', 'regex:/^[0-9]{2,4}$/'],
            'tel3' => ['required', 'regex:/^[0-9]{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'detail' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'category_id' => 'お問い合わせの種類',
            'first_name' => '名',
            'last_name' => '姓',
            'gender' => '性別',
            'email' => 'メールアドレス',
            'tel1' => '電話番号',
            'tel2' => '電話番号',
            'tel3' => '電話番号',
            'address' => '住所',
            'building' => '建物名',
            'detail' => 'お問い合わせ内容',
        ];
    }
}
