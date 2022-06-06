<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class main_category extends Model
{
    use HasFactory;

    protected $fillable=['translation_lang','translation_of','name','slug','photo','active','created_at','updated_at'];


    protected $hidden=[];

    public $timestamps=true;


    /*
    connect model with Observer ,to change the active auto for vendor when change 
    the active in main category
    */
    protected static function boot()
    {
        parent::boot();
        main_category::observe(MainCategoryObserver::class);
    }

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
        return $query->select('id','translation_lang','translation_of','name','slug','photo','active','created_at','updated_at');
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

    /*self relation to return the translation langauge,from same model
    self::class  ->relation with same model
    */
    public function categories()
    {
        return $this->hasMany(self::class,'translation_of');
    }

    //relation one to many between main_category and vendor
    //every main_category has many more than one vendor
    public function vendors()
    {
        return $this->hasMany(vendor::class,'category_id');

    }
}
