<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 */

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name' , 'parent_id'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function subs()
    {
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id' , 'id');
    }

    public function delete()
    {
        foreach ($this->items() as $key => $item) {
            image_delete($item->image , 'items');
        }

        return parent::delete();
    }
}
