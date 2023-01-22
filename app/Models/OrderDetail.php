<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property Order $order_id
 * @property Item $item_id
 * @property string $status
 * @property int $price
 * @property int $quantity
 * @property int $discount
 */

class OrderDetail extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'order_id' , 'item_id' , 'status' ,'price' , 'quantity' , 'discount'
    ];

    /**
     * retrieve order's item
     *
     * @return belongTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }
    
    public function price_after_discount()
    {
        if($this->parent_order()->first()->old == 0){
            return $this->price - ($this->price * $this->discount / 100);
        }else{
            return $this->price - $this->discount;
        }
    }
    
    public function total_discount()
    {
        if($this->parent_order()->first()->old == 0){
            return $this->price * $this->discount / 100;
        }else{
            return $this->discount;
        }
    }

    public function parent_order()
    {
        return $this->belongsTo(Order::class , 'order_id' , 'id')->withTrashed();
    }
}
