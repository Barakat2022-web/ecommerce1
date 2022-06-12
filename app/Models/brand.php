<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class brand extends Model
{
    use HasFactory;
    use Translatable;
    

    protected $with=['translations'];

    protected $fillable=['active'];

    //The casts attribute active is store in db as 0 or 1 when retrieve using model return true or false
    protected $casts=['active'=>'boolean'];

    protected $translatedAttributes=['name'];

    
}
