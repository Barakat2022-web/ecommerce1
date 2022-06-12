<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;

    protected $fillable=['parent_id','translation_lang','translation_of','name','slug','photo','active','created_at','updated_at'];


    public function scopeActive($query)
    {
        return $query->where('active',1);
    }

    public function getActive()
    {
        //to don't retrieve 1 or 2 when retrieve active value
        return $this->active==1?'مفعل':'غير مفعل';
    }
    public function scopeSelection($query)
    {
        return $query->select('id','parent_id','translation_lang','translation_of','name','slug','photo','active','created_at','updated_at');
    }

    //when want to get photo from model ,get from this method
    public function getPhotoAttribute($value)
    {
        return ($value!==null)?asset($value):'';
    }

    public function scopeArabic($query)
    {
        return  $query->where('translation_of',0);
    }

    //get MainCategory for SubCategory

    public function MainCategory()
    {
        return $this->belongsTo(main_category::class,'category_id');
    }

}
