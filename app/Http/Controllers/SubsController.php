<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberEmail;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscriptions',
        ]);

        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();

        Mail::to($subs)->send(new SubscriberEmail($subs));

        return redirect()->back()->with('info', 'Проверьте Вашу почту');
    }

    public function verify($token)
    {
        $subs = Subscription::findByToken($token);
        $subs->confirm();

        return redirect()->route('home')->with('success', 'Вы успешно подписались на рассылку!');
    }
}
