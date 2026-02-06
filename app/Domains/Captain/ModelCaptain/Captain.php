<?php

namespace App\Domains\Captain\ModelCaptain;
use App\Domains\Client\ModelClient\Client;
use Illuminate\Database\Eloquent\Model;
class Captain extends Model
{
      // = "يا Model، تقدر تستخدم Factory عشان تنشئ بيانات وهمية بسهولة"
    protected $fillable = ['name','email','password','captain_code'];
    public function clients(){
    return $this->hasMany(Client::class);
}
}
