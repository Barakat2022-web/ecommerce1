<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            //required_without:id this form get from edit ,mean you can update this field or keep it
            'logo' => 'required_without:id|mimes:jpg,jpeg,png',
            'name'=>['required','string','max:150'],
            'mobile'=>['required','max:15','unique:vendors,mobile,'.$this->id],//$this->id use when update on unique field
            'email'=>['required','nullable','email','unique:vendors,email,'.$this->id],//$this->id use when update on unique field
            'category_id'=>['required','exists:main_categories,id'],
            'address'=>['required_without:id','string','max:100'],
            'password'=>['required_without:id','string','min:6']
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
            'required'=>'هذا الحقل مطلوب',
            'max'=>'هذا الحقل يجب ان لا يزيد عن :max حرف',
            'category_id.exists'=>'القسم المدخل غير موجود',
            'email.email'=>'ادخل البريد الالكتروني بطريقة صحيحة',
            'address.string'=>'العنوان لا بد ان يكون حروف و ارقام',
            'name.string'=>'الاسم لا بد ان يكون حروف و ارقام',
            'logo.required_without'=>'تحميل الصورة ضروري في حال انشاء المتجر',
            'email.unique'=>'هذا البريد الالكتروني للتاجر مسجل مسبقا ، يرجى اختيار بريد اخر',
            'mobile.unique'=>'رقم الهاتف مستخدم من قبل'

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
