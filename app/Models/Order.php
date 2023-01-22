<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * @property int $id
 * @property Client $client_id
 * @property int $discount
 * @property int $working_day
 * @property string $notes || Nullable
 * @property enum $status  1 || 0
 * @property enum $payment  1 || 0
 * @property int $total
 * @property timestamp payment_date
 */

class Order extends Model
{
    use HasFactory  , SoftDeletes;

    protected $fillable = [
        'client_id' , 'discount' , 'working_day' , 'notes' ,'status' , 'payment' , 'total' , 'payment_date' , 'employee_name'
    ];


    /**
     * change payment status
     *
     * @return Boolean
     */
    public function change_payment()
    {
        if ($this->payment == "0") {
            return $this->update([
                'payment' => "1",
                'payment_date' => Carbon::now()
            ]);
        }else{
            return $this->update([
                'payment' => "0"
            ]);
        }
    }

    /**
     * calculate no. of working days
     *
     * @return response
     */
    public function working_days_count()
    {
        return $this->created_at->addDays($this->working_day);
    }


    /**
     * return order details
     *
     * @return HasMany
     */
    public function details()
    {
        return $this->hasMany(OrderDetail::class)->withTrashed();
    }
    
    /**
     * قيمه الطلب قبل الخصم
     **/
    public function total_before_item_discount()
    {
        $total = 0;
        foreach($this->details()->get() as $detail)
        {
            $total = $total + $detail->price;
        }
        
        $total = $total + $this->service + $this->delivery;
        
        return $total;
    }
    
    /**
     *قيمه الخصم لو علي المنتجات بس  
     **/
    public function total_discount()
    {
        
        $total = 0;
        if($this->discount != 0){
            $total = $total + $this->service + $this->delivery;
            if ($this->old == 0) {
                $total = $this->discount * $this->total / 100;
            }else{
                $total = $this->discount;
            }
        }
        
        foreach($this->details()->get() as $detail)
        {
            $total = $total + $detail->total_discount();
        }
        
        return $total;
    }
    
    /**
     * السعر النهائي بعد الخصم
     **/
    public function total_price_after_discount()
    {
        if ($this->old == 0) {
            return $this->total - ($this->total * $this->discount / 100); 
        }else{
            return $this->total - $this->discount; 
        }
    }

    /**
     * return order's client
     *
     * @return belongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
}
