<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
    use HasFactory;

    public static function findByToken($token)
    {
        return static::where('token', $token)->firstOrFail();
    }

    public static function add($email)
    {
        $obj = new static;
        $obj->email = $email;
        $obj->save();

        return $obj;
    }

    public function generateToken()
    {
        $this->token = Str::random(100);
        $this->save();
    }

    public function confirm()
    {
        $this->token = null;
        return $this->save();
    }
    
    public function remove()
    {
        $this->delete();
    }
}
