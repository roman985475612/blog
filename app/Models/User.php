<?php

namespace App\Models;

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
        'password',
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
        $obj->password = bcrypt($fields['password']);
        $obj->save();

        return $obj;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->password = bcript($fields['password']);
        $this->save();
    }

    public function remove()
    {
        $this->deleteAvatarIfExists();
        $this->delete;
    }

    public function uploadAvatar($image)
    {
        if ($image === null) { return; }

        $filename = str_random(10) . '.' . $image->extends;
        
        $image->saveAS('uploads', $filename);
        
        $this->deleteAvatarIfExists();
        $this->image = $filename;
        $this->save();

    }

    public function getAvatar()
    {
        return ($this->image) ? "/uploads/$this->image" : "https://fakeimg.pl/200x100/CCCCCC/?text=No%20avatar";
    }

    public function deleteAvatarIfExists()
    {           
        if ($this->image !== null) {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function toggleAdmin($value)
    {
        $this->is_admin = ($value) ? User::IS_ADMIN : User::NORMAL;
        $this->save();

        return $this-is_admin;
    }

    public function toggleBan($value)
    {
        $this->status = ($value) ? User::IS_BANNED : User::IS_ACTIVE;
        $this->save();

        return $this->status;
    }
}
