<?php

namespace App\Models;

use Dionisvl\Shop\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function allow()
    {
        $this->status = 1;
        $this->save();
    }

    public function disallow(){
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus(){
        if ($this->status == 0) {
            return $this->allow();
        }

        return $this->disAllow();
    }

    public function remove()
    {
        $this->delete();
    }

    public function getAuthorImage()
    {
        if (empty($this->author)) {
            return '/storage/blog_images/no-image.png';
        }

        return $this->author->getImage();
    }
}
