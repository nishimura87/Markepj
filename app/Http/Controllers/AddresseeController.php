<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddresseeRequest;
use App\Models\Addressee;
use Illuminate\Support\Facades\Auth;


class AddresseeController extends Controller
{
    public function createAddressee(Request $request)
    {
        $user = Auth::user();
        $addressee =  Addressee::where('user_id', '=', $user['id'])->first();

        if(isset($addressee)){
            return view('member.addressee',compact('addressee'));
        }
        else{
            return view('member.addressee');
        }
    }

    public function storeAddressee(AddresseeRequest $request)
    {
        $user = Auth::user();

        $addressee =  Addressee::where('user_id', '=', $user['id'])->first();
        if(empty($addressee)){
        Addressee::create([
            'user_id' => $user->id,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
            'phone_number' => $request->phone_number,
            'name' => $request->name,
            'kana' => $request->kana
        ]);
        }

        if(!empty($addressee)){
        $form = $addressee->fill([
            'user_id' => $user->id,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
            'phone_number' => $request->phone_number,
            'name' => $request->name,
            'kana' => $request->kana
        ])->save();
        }

        $session = $request->session()->get('back_url');
        $request->session()->forget('back_url');
        
        if($session == 'member'){
            return redirect()->route('infoUser');
        }
        if($session == 'order'){
            return redirect()->route('cartList');
        }
    }
}
