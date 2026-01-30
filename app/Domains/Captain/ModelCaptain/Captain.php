<?php

namespace App\Domains\Captain\ModelCaptain;
use App\Domains\Client\ModelClient\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Captain extends Model
{
    use HasFactory;  // = "يا Model، تقدر تستخدم Factory عشان تنشئ بيانات وهمية بسهولة"
    protected $fillable = ['name','email','password','captain_code'];
    public function clients(){
    return $this->hasMany(Client::class);
}
}
