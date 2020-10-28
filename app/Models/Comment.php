<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    const DISALLOW = 0;
    const ALLOW = 1;

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }

    public function allow()
    {
        $this->status = Comment::ALLOW;
        $this->save();

        return $this->status;
    }

    public function disAllow()
    {
        $this->status = Comment::DISALLOW;
        $this->save();

        return $this->status;
    }

    public function toggleStatus()
    {
        if ($this->status == Comment::DISALLOW) {
            return $this->allow();
        }

        return $this->disAllow();
    }

    public function remove()
    {
        $this->delete();
    }
}
