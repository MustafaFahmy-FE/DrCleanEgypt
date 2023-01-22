<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $image
 * @property integer $laundry_price
 * @property integer $ironing_price
 * @property Category $category_id
 */

class Item extends Model
{
    use HasFactory , SoftDeletes;

    protected $with = ['orders'];

    protected $fillable = [
        'name' , 'image' , 'laundry_price' , 'ironing_price' , 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function delete()
    {
        image_delete($this->image , 'items');

        return parent::delete();
    }
}
