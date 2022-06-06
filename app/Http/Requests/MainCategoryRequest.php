<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'category' => 'required|array|min:1',
            'category.*.name' => 'required',
            'category.*.translation_lang' => 'required',
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
            'category.*.name.required'=>'يرجى ادخال اسم القسم',
            'category.*.translation_lang.required'=>'يرجى ادخال اسم اختصار اللغة',
            'photo.required_without'=>'تحميل الصورة ضروري في حال انشاء القسم',
            'photo.mimes'=>' jpg or jpeg or png الصورة يجب ان تكون من نوع '
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
