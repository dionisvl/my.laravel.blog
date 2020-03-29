<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'date',
        'detail_text',
        'preview_text',
        'image',
        'price',
        'balance',
        'composition',
        'features',
        'size',
        'manufacturer',
        'delivery',
        'stars',
    ];

    public static function add($fields)
    {
        $post = new static;

        $post->fill($fields);
//        $post->title = $fields['title'];
//        $post->category_id = $fields['category_id'];
//        $post->date = $fields['date'];
//        $post->detail_text = $fields['detail_text'];
//        $post->preview_text = $fields['preview_text'];
        $post->slug = Str::slug($fields['title']);
        $post->user_id = Auth::user()->id;
        $post->save();

        return $post;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }

    public function removeImage()
    {
        if ($this->image != null) {
            Storage::delete('storage/shop_uploads/' . $this->image);
        }
    }

    public function uploadImage($image)
    {
        if ($image == null) {
            return;
        }

        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('storage/shop_uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function getImage()
    {
        if ($this->image == null) {
            if (\Route::getCurrentRoute()->uri() == '/') {
                return '/storage/shop_uploads/no-image.png';
            }
            return '/storage/shop_uploads/no-image.png';
        }
        return '/storage/shop_uploads/' . $this->image;
    }

    public function setCategory($id)
    {
        if ($id == null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    public function getCategoryTitle()
    {
        return ($this->category != null)
            ? $this->category->title
            : 'Нет категории';
    }

    public function related()
    {
        return self::where('category_id', '=', $this->category_id)->take(5)->get()->except($this->id);
    }

    public function getComments()
    {
        $comments = $this->comments()->where('status', 1)->get();
        return $comments;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getUrl()
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/' . $this->slug;
    }

    public function getCategoryID()
    {
        return $this->category != null ? $this->category->id : null;
    }
}
