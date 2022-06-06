<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;

    protected $fillable=['name','logo','mobile','password','address','email','active','category_id','created_at','updated_at'];

    protected $hidden=['password'];

    public function scopeSelection($query)
    {
        return $query->select('id','category_id','name','logo','mobile','address','email','active');
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

    public function getLogoAttribute($value)
    {
        return ($value!==null)?asset($value):'';
    }


    //Inverse relation with main_category
    public function MainCategory()
    {
        return $this->belongsTo(main_category::class,'category_id','id');

    }

    //return bcrypt password from model
    public function setPasswordAttribute($password)
    {
        if(!empty($password))
        {
            $this->attributes['password']=bcrypt($password);
        }
    }


}
