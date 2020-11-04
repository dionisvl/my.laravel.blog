<?php

namespace App;

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;

    protected $fillable = ['title', 'content', 'date', 'description', 'views_count'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->slug = Str::slug($fields['title']);
        $post->user_id = Auth::user()->id;
        $post->save();

        return $post;
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
            Storage::delete('storage/uploads/' . $this->image);
        }
    }

    public function uploadImage($image)
    {
        if ($image == null) {
            return;
        }

        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('storage/uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function getImage()
    {
        if ($this->image == null) {
            if (\Route::getCurrentRoute()->uri() == '/') {
                return '/storage/blog_images/no-image.png';
            }
            return '/storage/blog_images/no-image.png';
        }
        return '/storage/uploads/' . $this->image;
    }

    public function setCategory($id)
    {
        if ($id == null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if ($ids == null) {
            return;
        }

        $this->tags()->sync($ids);
    }

    public function setDraft()
    {
        $this->status = Post::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = Post::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value == null) {
            return $this->setDraft();
        }

        return $this->setPublic();
    }

    public function setFeatured()
    {
        $this->is_featured = 1;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured = 0;
        $this->save();
    }

    public function toggleFeatured($value)
    {
        if ($value == null) {
            return $this->setStandart();
        }

        return $this->setFeatured();
    }

    public function setDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;
    }

    public function getDateAttribute($value)
    {
//        $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/y');
        return $date;
    }

    public function getCategoryTitle()
    {
        return ($this->category != null)
            ? $this->category->title
            : 'Нет категории';
    }

    public function getTagsTitles()
    {
        return (!$this->tags->isEmpty())
            ? implode(', ', $this->tags->pluck('title')->all())
            : 'Нет тегов';
    }

    public function getCategoryID()
    {
        return $this->category != null ? $this->category->id : null;
    }

    public function getDate()
    {
        //return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
        //return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('F d, Y');
        return DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('F d, Y');
    }

    public function hasPrevious()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    public function getPrevious()
    {
        $postID = $this->hasPrevious(); //ID
        return self::find($postID);
    }

    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }

    public function related()
    {
        return self::where('category_id', '=', $this->category_id)->take(5)->get()->except($this->id);
    }

    public function hasCategory()
    {
        return $this->category != null ? true : false;
    }

    public static function getPopularPosts()
    {
        return self::orderBy('views', 'desc')->take(3)->get();
    }

    public function getComments()
    {
        $comments = $this->comments()->where('status', 1)->get();
//        foreach ($comments as $key => $comment){
//            $comments[$key]->load('author');
//            $comments[$key]->getRelations();
//            //dd($comment);
//        }
        return $comments;
    }

    public function getUrl()
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/post/' . $this->slug;
    }

    public function getViewsCount()
    {
        return empty($this->views_count) ? 1 : (int)$this->views_count;
    }

    public function updateViewsCount()
    {
//        if (session($this->id) != true){
//            session([$this->id => true]);
//        } else {
//
//        }
        $this->views_count = $this->views_count + 1;
        $this->save();
    }

    public function getDescription()
    {
        return empty($this->description) ? 'Cправочник по тематике программирования на языках PHP, JS' : strip_tags($this->description);
    }

    public function getTitle()
    {
        if (\Route::getCurrentRoute()->uri() == '/') {
            return 'WIKI, блог программиста, лучшие практики PHP, JS, SQL';
        } else {
            if (empty($this->title)) {
                return 'Лучшие практики PHP, JS, SQL, блог программиста.';
            } else {
                return $this->title;
            }
        }
    }

    /* Аксессор для получения количества лайков, $post->likes_count*/
//    public function getLikesCountAttribute()
//    {
//        return $this->likes()->where('post_id', $this->id)->count();
//    }

    /* Аксессор для определения поставлен ли лайк этим пользователем, $post->is_liked */
    public function getIsLikedAttribute()
    {
        return PostController::isLiked($this->id);
    }
}
