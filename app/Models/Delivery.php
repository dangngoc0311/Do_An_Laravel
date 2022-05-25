<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = ['tp_id','qh_id','xa_id','price'];
    public function getCity()
    {
        return $this->hasOne(City::class, 'id', 'tp_id');
    }
    public function getProvince()
    {
        return $this->hasOne(Province::class, 'id', 'qh_id');
    }
    public function getCommune()
    {
        return $this->hasOne(Commune::class, 'id', 'xa_id');
    }

}
