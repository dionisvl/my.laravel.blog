<?php

namespace Dionisvl\Shop\Models;

use App\Category;
use App\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'date',
        'detail_text',
        'preview_text',
        'detail_picture',
        'preview_picture',
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
        $product = new static;

        $product->fill($fields);
        $product->slug = static::getSlug($fields['title']);
        $product->user_id = Auth::user()->id;
        $product->save();

        return $product;
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
        $this->removeImage('detail_picture');
        $this->removeImage('preview_picture');
        $this->delete();
    }

    public function removeImage(string $type_picture)
    {
        if ($this->{$type_picture} != null) {
            Storage::delete('storage/shop_uploads/' . $this->{$type_picture});
        }
    }

    public function uploadImage($file_picture, string $type_picture)
    {
        if (empty($file_picture)) {
            return;
        }

        $this->removeImage($type_picture);
        $filename = str_random(10) . '.' . $file_picture->extension();
        $file_picture->storeAs('storage/shop_uploads', $filename);
        $this->{$type_picture} = $filename;
        $this->save();
    }

    public function getImage(string $type_picture)
    {
        if ($this->{$type_picture} == null) {
            if (Route::getCurrentRoute()->uri() == '/') {
                return '/storage/shop_uploads/no-image.png';
            }
            return '/storage/shop_uploads/no-image.png';
        }
        return '/storage/shop_uploads/' . $this->{$type_picture};
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
