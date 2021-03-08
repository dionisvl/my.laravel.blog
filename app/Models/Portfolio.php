<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Portfolio
 * @package App\Models
 * @property string slug
 * @property int user_id
 * @property bool is_featured
 * @property string image
 * @property bool status
 * @property datetime created_at
 */
class Portfolio extends Model
{
    public const IS_DRAFT = 0;
    public const IS_PUBLIC = 1;

    protected $fillable = ['title', 'content', 'description', 'views_count'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function add($fields): self
    {
        $post = new static;
        $post->fill($fields);
        $post->slug = Str::slug($fields['title']);
        $post->user_id = Auth::user()->id;
        $post->save();

        return $post;
    }

    public function edit($fields): void
    {
        $this->fill($fields);
        $this->slug = Str::slug($fields['title']);
        $this->save();
    }

    public function remove(): void
    {
        $this->removeImage();
        $this->delete();
    }

    public function removeImage(): void
    {
        if ($this->image !== null) {
            Storage::delete('storage/uploads/portfolio/' . $this->image);
        }
    }

    public function uploadImage($image): void
    {
        if ($image === null) {
            return;
        }

        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('storage/uploads/portfolio', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function getImage(): string
    {
        if ($this->image === null) {
            return '/storage/blog_images/no-image.png';
        }
        return '/storage/uploads/portfolio/' . $this->image;
    }

    public function setDraft(): void
    {
        $this->status = Post::IS_DRAFT;
        $this->save();
    }

    public function setPublic(): void
    {
        $this->status = Post::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value): void
    {
        if ($value === null) {
            $this->setDraft();
        }

        $this->setPublic();
    }

    public function setFeatured(): void
    {
        $this->is_featured = 1;
        $this->save();
    }

    public function setStandard(): void
    {
        $this->is_featured = 0;
        $this->save();
    }

    public function toggleFeatured($value): void
    {
        if ($value === null) {
            $this->setStandard();
        }

        $this->setFeatured();
    }

    public function getDate(): string
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('F d, Y');
    }

    public function getUrl(): string
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/portfolio/' . $this->slug;
    }
}
