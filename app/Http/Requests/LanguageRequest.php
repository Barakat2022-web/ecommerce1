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
        //can put admin guard 
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
            'name'=>['required','max:100'],
            'abbr'=>['required','string','max:10'],
            'active'=>['required','in:1,2'],
            'direction'=>['required','in:rtl,ltr'],
        ];
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'=>'هذا الحقل المطلوب',
            'in'=>'القيمة المدخلة غير صحيحة',
            'name.string'=>'ادخل اسم اللغة بالحروف فقط',
            'abbr.max'=>'هذا الحقل اكبر من 10 احرف',
            'abbr.string'=>'ادخل اختصار اللغة بالحروف فقط',
            'name.max'=>'اسم اللغة اكبر من 100 حرف',


        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

}
