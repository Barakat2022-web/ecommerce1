<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable=['name','email','photo','password','created_at','updated_at'];

    //$guarded=[] this mean all column is fillable and nothing hidden
    //protected $guarded=[];

    public $timestamps=true;

    protected $hidden=['password','remeber_token'];
}
