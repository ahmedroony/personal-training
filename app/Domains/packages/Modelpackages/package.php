<?php

namespace App\Domains\packages\Modelpackages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Client\ModelClient\Client;
class package extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','description','price','duration_days'];
    public function clients(){
        return $this->hasMany(Client::class);
    }
}
