<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property integer $building
 * @property integer $floor
 * @property integer $apartment
 */

class Client extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name' , 'address' , 'phone' , 'building' , 'floor' , 'apartment'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
