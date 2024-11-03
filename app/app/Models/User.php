<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class User.
 * @package App\Models
 * @property string password
 * @property string avatar
 * @property bool is_admin
 * @property int status
 * @property int id
 */
class User extends Authenticatable
{
    use Notifiable;

    public const IS_BANNED = 1;
    public const IS_ACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fields): User
    {
        $user = new User();

        DB::transaction(function () use ($user, $fields) {
            $user->fill($fields);
            $user->save();
            // todo: fix email verification, route notification is needed
            // $user->sendEmailVerificationNotification();
        });

        return $user;
    }

    public function edit($fields): void
    {
        $this->fill($fields);

        $this->save();
    }

    public function generatePassword($password): void
    {
        if ($password !== null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove(): void
    {
        $this->delete();
    }

    public function uploadAvatar($image): void
    {
        if ($image === null) {
            return;
        }

        $this->removeAvatar();

        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('storage/uploads', $filename);
        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar(): void
    {
        if ($this->avatar !== null) {
            Storage::delete('storage/uploads/' . $this->avatar);
        }
    }

    public function getImage(): string
    {
        if ($this->avatar === null) {
            return '/storage/blog_images/no-image.png';
        }
        return '/storage/uploads/' . $this->avatar;
    }

    public function makeAdmin(): void
    {
        $this->is_admin = 1;
        $this->save();
    }

    public function makeNormal(): void
    {
        $this->is_admin = 0;
        $this->save();
    }

    public function toggleAdmin($value): void
    {
        if ($value === null) {
            $this->makeNormal();
        }

        $this->makeAdmin();
    }

    public function ban(): void
    {
        $this->status = self::IS_BANNED;
        $this->save();
    }

    public function unban(): void
    {
        $this->status = self::IS_ACTIVE;
        $this->save();
    }

    public function toggleBan($value): void
    {
        if ($value === null) {
            $this->unban();
        }

        $this->ban();
    }
}
