<?php

namespace App\Domains\Client\ModelClient;
use App\Domains\Captain\ModelCaptain\Captain;
use Illuminate\Database\Eloquent\Model;
use App\Domains\packages\Modelpackages\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\ClientFactory;
class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone_number','password','status','captain_id','package_name'];
    public function captain(){
        return $this->belongsTo(Captain::class);
    }
        protected static function newFactory()
    {
        return ClientFactory::new();
    }

}
