<?php

declare(strict_types=1);

namespace Dionisvl\FrontParts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

/**
 * Class FrontPart.
 * @package Dionisvl\FrontParts\Models
 * @property string slug
 */
class FrontPart extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_name',
        'detail_text',
        'preview_text',
        'type',
        'status',
    ];

    public static function add($fields): self
    {
        $order = new static();

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
        } catch (Throwable $e) {
            throw new RuntimeException('error during deleting ' . __CLASS__ . ' element');
        }
    }
}
