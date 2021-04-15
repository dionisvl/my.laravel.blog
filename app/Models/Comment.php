<?php

namespace App\Models;

use Dionisvl\Shop\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Comment
 * @package App\Models
 * @property int status
 * @property string text
 * @property int post_id
 * @property int user_id
 */
class Comment extends Model
{
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function allow(): void
    {
        $this->status = 1;
        $this->save();
    }

    public function disallow(): void
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus(): void
    {
        if ($this->status === 0) {
            $this->allow();
        } else {
            $this->disAllow();
        }
    }

    public function remove(): void
    {
        $this->delete();
    }

    public function getAuthorImage(): string
    {
        if (empty($this->author)) {
            return '/storage/blog_images/no-image.png';
        }

        return $this->author->getImage();
    }
}
