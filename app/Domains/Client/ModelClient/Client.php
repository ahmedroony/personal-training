<?php

namespace App\Domains\Client\ModelClient;
use App\Domains\Captain\ModelCaptain\Captain;
use Illuminate\Database\Eloquent\Model;
use App\Domains\packages\Modelpackages\package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email','package_id', 'phone_number','password','status','captain_id','package_id'];
    public function captain(){
        return $this->belongsTo(Captain::class);
    }
    public function package(){
        return $this->belongsTo(package::class);
    }
}
