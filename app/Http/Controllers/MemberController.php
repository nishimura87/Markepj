<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function infoUser(Request $request)
    {
        return view('member.info');
    }

    public function editUser(Request $request)
    {
        return view('member.edit');
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $update = $user->fill([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
            'phone_number' => $request->phone_number,
            ])->save();

        return redirect('/member');
    }

    public function editPassword()
    {
        return view('member.password');
    }

    public function updatePassword(Request $request)
    {
        //以前のパスワード
        $user = \Auth::user();
        if(!password_verify($request->current_password,$user->password))
        {
            return redirect('/member/password')
            ->with('warning','パスワードが違います');
        }

        //新規パスワード
        $rulu = [
            'new_password' => ['required', 'regex:/^(?=.*[0-9])(?=.*[a-z])[0-9a-z\-]{8,24}$/']
        ];

        $message = [
            'new_password.required' => 'パスワードは入力必須です',
            'new_password.regex' => 'パスワードは半角英数字を1つずつ含めた8文字以上24文字以内で入力してください',
        ];

        $validator = Validator::make($request->all(), $rulu, $message);

        if ($validator->fails()) {
            return redirect('/member/password')
            ->withErrors($validator);
        }
        
    
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect ('/member')
        ->with('status','パスワードの変更が終了しました'); 
    }
}
