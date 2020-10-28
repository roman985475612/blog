<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public static function add($email)
    {
        $obj = new static;
        $obj->email = $email;
        $obj->token = str_random(100);
        $obj->save();

        return $obj;
    }

    public function remove()
    {
        $this->delete();
    }
}
