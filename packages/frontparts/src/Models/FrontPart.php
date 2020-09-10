<?php

namespace Dionisvl\FrontParts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FrontPart extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_name',
        'detail_text',
        'preview_text',
        'type',
        'status'
    ];

    public static function add($fields): FrontPart
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
        try {
            $this->delete();
        } catch (\Exception $e) {
            throw new \RuntimeException('error during deleting ' . __CLASS__ . ' element');
        }
    }
}
