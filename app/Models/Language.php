<?php

namespace App\Models;

use App\Scopes\scopeActive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable=['abbr','locale','name','direction','active','created_at','updated_at'];

    protected $hidden=[];


    public function scopeActive($query)
    {
        return $query->where('active',1);
    }
    public function scopeSelection($query)
    {
        return $query->select('id','abbr','name','direction','active');
    }

    public function getActive()
    {
        //to don't retrieve 1 or 2 when retrieve active value
        return $this->active==1?'مفعل':'غير مفعل';
    }

    public function getDirection()
    {
         return $this->direction=='rtl'?'من اليمين الى اليسار':'من اليسار الى اليمين';
    }

}
