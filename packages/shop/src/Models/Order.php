<?php

namespace Dionisvl\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'price',
        'user_id',
        'phone',
        'address',
        'notes',
        'contents',
        'contents_json',
        'manager',
        'manager_id',
        'status',
        'status_date'
    ];

    public static function add($fields)
    {
        $order = new static;

        $order->fill($fields);
        $order->slug = static::getSlug($fields['title']);
        $order->save();

        return $order;
    }

    private static function getSlug($title)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 2;
        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }
        return $slug;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->slug = static::getSlug($fields['title']);
        $this->save();
    }

    public function remove()
    {
        $this->delete();
    }

}
