<?php

namespace Dionisvl\Shop\Models;

use Dionisvl\Shop\database\factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Order
 * @package Dionisvl\Shop\Models
 * @property string slug
 */
class Order extends Model
{
    use HasFactory;
    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return OrderFactory::new();
    }

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

    public static function add($fields): self
    {
        $order = new static;

        $order->fill($fields);
        $order->slug = static::getSlug($fields['title']);
        $order->save();

        return $order;
    }

    private static function getSlug($title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 2;
        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }
        return $slug;
    }

    public function edit($fields): void
    {
        $this->fill($fields);
        $this->slug = static::getSlug($fields['title']);
        $this->save();
    }

    public function remove(): void
    {
        $this->delete();
    }

}
