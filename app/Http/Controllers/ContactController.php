<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactsSendmail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return view('contact.index');
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();

        return view('contact.confirm', [
        'inputs' => $inputs,
        ]);
    }

    public function send(Request $request)
    {
        $action = $request->input('action');
        $inputs = $request->except('action');

        if($action !== 'submit'){
            return redirect()
            ->route('index')
            ->withInput($inputs);
        } else {
            \Mail::to($inputs['email'])->send(new ContactsSendmail($inputs));
            \Mail::to('marke.b.2023@gmail.com')->send(new ContactsSendmail($inputs));
            $request->session()->regenerateToken();
            return view('contact.thanks');
        }
    }
}
