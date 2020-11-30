<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        Comment::create([
            'text'    => $request->get('text'),
            'post_id' => $request->get('post_id'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Ваш комментарий скоро будет добавлен.');
    }
}
