<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' => 'required|max:100',
            'abbr' => 'required|string|max:10',
            // 'active' => 'required|in:0,1',
            'direction' => 'required|in:rtl,ltr'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'in' => 'القيمة المدخلة غير صحيحة',
            'name.string' => 'اسم اللغة يجب أن يكون أحرف',
            'name.max' => 'الأسم يجب أن لا يزيد عن مئة حرف',
            'abbr.string' => 'أختصار اللغة يجب أن يكون أحرف',
            'abbr.max' => 'الأسم يجب أن لا يزيد عن عشرة أحرف',
        ];
    }
}
