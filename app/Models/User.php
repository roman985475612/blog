<?php

namespace App\Models;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const NORMAL = 0;
    const IS_ADMIN = 1;
    const IS_ACTIVE = 0;
    const IS_BANNED = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fields)
    {
        $obj = new static;
        $obj->fill($fields);
        $obj->save();

        return $obj;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();

        return $this;
    }

    public function generatePassword($password)
    {
        if ($password != null) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            $this->save();
        }

        return $this;
    }

    public function remove()
    {
        $this->removeImage()
             ->delete();
    }

    public function uploadAvatar($avatar)
    {
        if ($avatar == null)
            return;

        $this->removeImage();

        $filename = md5_file($avatar) . '.' . $avatar->extension();
        
        $avatar->storeAs('uploads', $filename);

        $this->avatar = $filename;
        $this->save();

        return $this;
    }

    public function storeAvatar(UploadedFile $avatar): string
    {
        $filename = md5_file($avatar) . '.' . $avatar->extension();
        
        $avatar->storeAs('uploads', $filename);

        return $filename;
    }

    public function getAvatar(int $size = 64)
    {
        if ($this->avatar) {
            return "/uploads/$this->avatar";
        }

        $digest = md5($this->email);

        return "https://www.gravatar.com/avatar/{$digest}?d=identicon&s={$size}";
    }

    public function removeImage()
    {           
        if ($this->avatar) {
            Storage::delete('uploads/' . $this->avatar);
        }

        return $this;
    }

    public function toggleAdmin($value)
    {
        $this->is_admin = ($value) ? User::IS_ADMIN : User::NORMAL;
        $this->save();

        return $this->is_admin;
    }

    public function toggleBan($value)
    {
        $this->status = ($value) ? User::IS_BANNED : User::IS_ACTIVE;
        $this->save();

        return $this->status;
    }
}
