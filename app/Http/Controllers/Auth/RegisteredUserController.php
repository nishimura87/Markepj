<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'regex:/^(?=.*[0-9])(?=.*[a-z])[0-9a-z\-]{8,24}$/'],
            'postcode' => ['required', 'regex:/\A\d{3}[-]\d{4}\z/'],
            'address' => ['required'],
            'phone_number' => ['required', 'numeric', 'digits_between:8,11'],
        ],
        [
            'name.required' => '名前は入力必須です',
            'name.string' => '名前は文字列で入力してください',
            'name.max' => '名前は20文字以内で入力してください',
            'kana.required' => '名前(カタカナ)は入力必須です',
            'kana.string' => '名前(カタカナ)は文字列で入力してください',
            'kana.regix' => '名前(カタカナ)はカタカナで入力してください',
            'kana.max' => '名前(カタカナ)は20文字以内で入力してください',
            'email.required' => 'メールアドレスは入力必須です',
            'email.string' => 'メールアドレスは文字列で入力してください',
            'email.email' => 'メールアドレス形式で入力してください',
            'email.max' => 'メールアドレスは191文字以下で入力してください',
            'email.unique' => 'そのメールアドレスは使われています',
            'password.required' => 'パスワードは入力必須です',
            'password.regex' => 'パスワードは半角英数字を1つずつ含めた8文字以上24文字以内で入力してください',
            'postcode.required' => '郵便番号は入力必須です',
            'postcode.regex' => '郵便番号はハイフンを含めた８文字で入力してください',
            'address.required' => '住所は入力必須です',
            'phone_number.required' => '電場番号は入力必須です',
            'phone_number.numeric' => '電話番号はハイフンを除く数字形式で入力してください',
            'phone_number.digits_between' => '電場番号は8〜11文字の数字で入力してください',
        ]);

        $user = User::create([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
            'phone_number' => "$request->phone_number",
        ]);

        

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
